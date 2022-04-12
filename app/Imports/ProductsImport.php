<?php

namespace App\Imports;

use App\Models\Product;


use App\Models\Currency;
use App\Models\Document;
use App\Models\Image;
use App\Models\Property;


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
use Maatwebsite\Excel\Events\AfterImport;





class ProductsImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure, WithChunkReading
{

    use Importable, SkipsErrors, SkipsFailures;

    private $documents;
    private $currencies;

    public function __construct()
    {
        $this->documents = Document::select('id')->get()->toArray();
        $this->currencies = Currency::select('currency', 'Nominal', 'value')->get();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $data = [];
            $data['name'] = $row['name'];
            $data['slug'] = $row['slug'] ? $row['slug'] : NULL;
            $data['active'] = $row['active'] ? 1 : 0;
            $data['art_number'] = $row['art_number'] ? $row['art_number'] : NULL;
            $data['hit'] = $row['hit'] ? 1 : 0;
            $data['new'] = $row['new'] ? 1 : 0;
            $data['stock'] = $row['stock'] ? 1 : 0;
            $data['advice'] = $row['advice'] ? 1 : 0;
            $data['sort'] = $row['sort'] ? $row['sort'] : 500;
            $data['category_id'] = $row['category_id'] ? $row['category_id'] : NULL;
            $data['h1'] = $row['h1'] ? $row['h1'] : NULL;
            $data['meta_title'] = $row['meta_title'] ? $row['meta_title'] : NULL;
            $data['meta_keywords'] = $row['meta_keywords'] ? $row['meta_keywords'] : NULL;
            $data['meta_description'] = $row['meta_description'] ? $row['meta_description'] : NULL;
            $data['summary'] = $row['summary'] ? $row['summary'] : NULL;
            $data['description'] = $row['description'] ? $row['description'] : NULL;
            $data['accessory'] = $row['accessory'] ? $row['accessory'] : NULL;
            $data['currency'] = $row['currency'] ? trim($row['currency']) : 'RUB';
            $data['base_price'] = $row['base_price'] ? $row['base_price'] : 0;
            if($data['currency'] != 'RUB' && isset($data['currency']) && $data['base_price'] > 0 ) {
                $currency = $this->currencies->where('currency', $data['currency'])->first();
                $data['price'] = $data['base_price'] * $currency->Nominal * (float)$currency->value;
            } else {
                $data['price'] = $data['base_price'];
            }


            if($row['properties'] != NULL){
                if(is_array(json_decode($row['properties'], true)))  $data['properties'] = $row['properties'];
            } else {
                $data['properties'] = NULL;
            }

            if( $row['img']) {
                if (Storage::disk('public')->exists($row['img'])){
                    $ext = pathinfo(storage_path().$row['img'], PATHINFO_EXTENSION);
                    $fileBigName = 'big_'.time() . '_' . Str::lower(Str::random(2)) . '.' . $ext;
                    $fileSmallName = 'thumb_'.time() . '_' . Str::lower(Str::random(2)) . '.' . $ext;
                    $path_to = '/images/' . getfolderName();
                    $pathBig = Storage::disk('public')->putFileAs($path_to, new File('storage'.$row['img']), $fileBigName);
                    $pathSmall = Storage::disk('public')->putFileAs($path_to, new File('storage'.$row['img']), $fileSmallName);
                    Image::make(storage_path('app/public'.$pathSmall))->fit(100, 100)->save();
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
                    Image::make(storage_path('app/public'.$pathPrev))->resize(350, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();
                    $data['preview'] = 'storage/' . $pathPrev;
                }
            } else {
                $data['preview'] = NULL;
            }

            $product = Product::create($data);

            if($row['images']) {
                $images = explode( ',', $row['images'] );
                foreach ($images as $image){
                    if (Storage::disk('public')->exists(str_replace('storage', '', $image))) {
                        $ext = pathinfo(storage_path().$image, PATHINFO_EXTENSION);
                        $fileName = time() . '_' . Str::lower(Str::random(2)) . '.' . $ext;
                        $fileBigName = 'big_' . $fileName;
                        $fileSmallName = 'small_' . $fileName;
                        $path_to = '/images/' . getfolderName();
                        $pathBig = Storage::disk('public')->putFileAs($path_to, new File('storage'.$image), $fileBigName);
                        $pathSmall = Storage::disk('public')->putFileAs($path_to, new File('storage'.$image), $fileSmallName);
                        ImageManagerStatic::make(storage_path('app/public' . $path_to . '/' . $fileSmallName))->resize(100, 100, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save();
                        Image::create([
                            'product_id' => $product->id,
                            'img' => 'storage/' . $pathBig,
                            'thumbnail' => 'storage/' . $pathSmall
                        ]);
                    }
                }
            }

            if($row['documents']) {
                $documents = explode( '.', $row['documents'] );
                $arrID = [];
                foreach ($documents as $id ){
                    if(in_array($id, Arr::flatten($this->documents))) array_push($arrID, $id );
                }
                $product->documents()->attach($arrID);
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
