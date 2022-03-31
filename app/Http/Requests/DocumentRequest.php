<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Поле "Наменование" обязательно для заполнения',
            'file.mimetypes' => 'Файл документа должен иметь расширение: pdf,doc,docx,jpg,jpeg,png,ppt,txt,tif,xls,xlsx',
            'file.size' => 'Размер документа не должен превышать 10 мб.'
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'file' => 'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/jpeg,image/png,application/vnd.ms-powerpoint,text/plain,image/tiff,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|nullable',
            'file.size' => '10248|nullable'
        ];
    }
}
