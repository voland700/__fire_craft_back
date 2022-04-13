<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Imports\OffersImport;

class ImportController extends Controller
{

    public function  productsImportShow()
    {
        return view('admin.catalog.import.import_product');
    }

    public function productsImport (Request $request)
    {
        $messages = [
            'file.required' => 'Загрузите файл для импорта данных',
            'file.mimes' => 'Файл для иморта данных должен быть в Excel формате',
        ];
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv'
        ],$messages);
        $file = $request->file('file')->store('import');
        $import = new ProductsImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return back()->withStatus('Данные загружаются, мы отправим уведомление после завершения импорта.');
    }

    public function offersImportShow()
    {
        return view('admin.catalog.import.import_offer');

    }


    public function  offersImport(Request $request)
    {
        $messages = [
            'file.required' => 'Загрузите файл для импорта данных',
            'file.mimes' => 'Файл для иморта данных должен быть в Excel формате',
        ];
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv'
        ],$messages);
        $file = $request->file('file')->store('import');
        $import = new OffersImport;
        $import->import($file);
        if ($import->errors()->isNotEmpty()) {
            return back()->withStatus(['errors' => $import->errors()]);
        }
        return back()->withStatus('Данные опций загружены.');
    }




}
