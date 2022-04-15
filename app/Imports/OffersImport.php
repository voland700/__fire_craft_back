<?php

namespace App\Imports;

use App\Models\Offer;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Photo;
use App\Models\Color;



use Carbon\Carbon;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\File;

use Illuminate\Support\Arr;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithChunkReading;






class OffersImport  implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure, WithChunkReading
{

    use Importable, SkipsErrors, SkipsFailures;

    private $color;
    private $currencies;

    public function __construct()
    {
        $this->color = Color::select('id')->get()->pluck('id')->toArray();
        $this->currencies = Currency::select('currency', 'Nominal', 'value')->get();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){


            if($product = Product::where('id', $row['product_id'])->select('id', 'name')->first()) {





                if($row['name']) {
                    $data['name'] = $row['name'];
                }else{
                    $data['name'] = Color::select('id', 'name')->find($row['color_id'])->name;
                }

                $data['product_id'] = $row['product_id'];


                if(in_array($row['color_id'], $this->color)) {
                    $data['color_id'] = $row['color_id'];
                } else {
                    //dd($this->color);
                    return false;
                }
                $data['active'] = $row['active'] ? 1 : 0;
                $data['number'] = $row['number'] ? $row['number'] : NULL;
                $data['hit'] = $row['hit'] ? 1 : 0;
                $data['new'] = $row['new'] ? 1 : 0;
                $data['stock'] = $row['stock'] ? 1 : 0;
                $data['advice'] = $row['advice'] ? 1 : 0;
                $data['sort'] = $row['sort'] ? $row['sort'] : 50;
                $data['currency'] = $row['currency'] ? trim($row['currency']) : 'RUB';
                $data['base_price'] = $row['base_price'] ? $row['base_price'] : 0;
                if($data['currency'] != 'RUB' && isset($data['currency']) && $data['base_price'] > 0 ) {
                    $currency = $this->currencies->where('currency', $data['currency'])->first();
                    $data['price'] = $data['base_price'] * $currency->Nominal * (float)$currency->value;
                } else {
                    $data['price'] = $data['base_price'];
                }



                if( $row['img']) {
                    if (Storage::disk('public')->exists($row['img'])){
                        $ext = pathinfo(storage_path().$row['img'], PATHINFO_EXTENSION);
                        $fileBigName = 'big_'.time() . '_' . Str::lower(Str::random(2)) . '.' . $ext;
                        $fileSmallName = 'thumb_'.time() . '_' . Str::lower(Str::random(2)) . '.' . $ext;
                        $path_to = '/images/' . getfolderName();
                        $pathBig = Storage::disk('public')->putFileAs($path_to, new File('storage'.$row['img']), $fileBigName);
                        $pathSmall = Storage::disk('public')->putFileAs($path_to, new File('storage'.$row['img']), $fileSmallName);
                        \Intervention\Image\ImageManagerStatic::make(storage_path('app/public/'.$pathSmall))->fit(100, 100)->save();

                        $data['img'] = 'storage/' . $pathBig;
                        $data['thumbnail'] = 'storage/' . $pathSmall;
                    }
                } else {
                    $data['img'] = NULL;
                    $data['thumbnail'] = NULL;
                }

                if( $row['preview']) {
                    if (Storage::disk('public')->exists($row['preview'])){
                        $ext = pathinfo(storage_path().$row['preview'], PATHINFO_EXTENSION);
                        $filePrevName = 'small_'.time() . '_' . Str::lower(Str::random(2)) . '.' . $ext;
                        $path_to = '/images/' . getfolderName();
                        $pathPrev = Storage::disk('public')->putFileAs($path_to, new File('storage'.$row['preview']), $filePrevName);
                        \Intervention\Image\ImageManagerStatic::make(storage_path('app/public/'. $pathPrev))->resize(350, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save();
                        $data['preview'] = 'storage/' . $pathPrev;
                    }
                } else {
                    $data['preview'] = NULL;
                }

                $offer = Offer::create($data);

                if($row['images']) {
                    $images = explode( ',', $row['images'] );
                    foreach ($images as $image){
                        if (Storage::disk('public')->exists(str_replace('storage', '', $image))) {
                            $ext = pathinfo(storage_path().$image, PATHINFO_EXTENSION);
                            $fileName = time() . '_' . Str::lower(Str::random(2)) . '.' . $ext;
                            $fileBigName = 'big_' . $fileName;
                            $fileSmallName = 'small_' . $fileName;
                            $path_to = '/images/' . getfolderName();
                            $pathBig = Storage::disk('public')->putFileAs($path_to, new File('storage/'.$image), $fileBigName);
                            $pathSmall = Storage::disk('public')->putFileAs($path_to, new File('storage/'.$image), $fileSmallName);
                            \Intervention\Image\ImageManagerStatic::make(storage_path('app/public' . $path_to . '/' . $fileSmallName))->fit(100, 100)->save();
                            Photo::create([
                                'offer_id' => $offer->id,
                                'img' => 'storage/' . $pathBig,
                                'thumbnail' => 'storage/' . $pathSmall
                            ]);
                        }
                    }
                }


            }





        }

    }

    public function startRow(): int
    {
        return 2;
    }
    public function headingRow(): int
    {
        return 2;
    }
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
    /*
        public static function afterImport(AfterImport $event)
        {
        }
    */
    public function onFailure(Failure ...$failure)
    {
    }

}

