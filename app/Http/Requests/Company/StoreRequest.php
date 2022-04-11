<?php

namespace App\Http\Requests\Company;

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
            'tournament_rake_percent'       => 'required|integer|min:0|max:100',
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
            'tournament_rake_percent.required' => 'Поле "Процент рейка за турнир" обязательно к заполнению!',
            'tournament_rake_percent.integer' => 'Значение "Процент рейка за турнир" должно быть числом!',
            'tournament_rake_percent.min' => 'Значение "Процент рейка за турнир" должно быть больше 0!',
            'tournament_rake_percent.max' => 'Значение "Процент рейка за турнир" не может быть больше 100!',
        ];
    }
}
