<?php

namespace App\Http\Requests\Tournament;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'       => 'required|min:2|max:50',
            'blind_time' => 'required',
            'price' => 'required',
            'addon_price' => 'required',
            'bonus_stack' => 'required',
            'usual_stack' => 'required',
            'addon_stack' => 'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Поле "Название" обязательно к заполнению!',
            'name.min' => 'Поле "Название" должно быть более 2 символов!',
            'name.max' => 'Поле "Название" должно быть менее 50 символов!',
            'blind_time.required' => 'Поле "Длительность уровня" обязательно к заполнению!',
            'price.required' => 'Поле "Цена за ребай" обязательно к заполнению!',
            'addon_price.required' => 'Поле "Цена за аддон" обязательно к заполнению!',
            'bonus_stack.required' => 'Поле "Размер бонусного стека" обязательно к заполнению!',
            'usual_stack.required' => 'Поле "Размер обычного стека" обязательно к заполнению!',
            'addon_stack.required' => 'Поле "Размер при покупке аддона" обязательно к заполнению!',
        ];
    }
}
