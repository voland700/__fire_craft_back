<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name.required' => 'Поле "Наименование " обязательно для заполнения',
            'sort.integer' => 'Номер сортровки должен быть целым числом'
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'sort' => 'integer|nullable'
        ];
    }
}



