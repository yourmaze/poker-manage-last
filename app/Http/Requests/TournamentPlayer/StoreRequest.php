<?php

namespace App\Http\Requests\TournamentPlayer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'tournament_id' => 'required|integer|exists:tournaments,id',
            'double_amount' => 'required|boolean',
            'type'          => 'required|integer|in:1,2,3',
            'debtor'        => 'required|boolean',
            'name'          => 'required_if:debtor,1',
        ];
    }

    public function messages()
    {
        return [
            'name.required_if' => 'Поле "Имя" обязательно к заполнению, если игрок не оплатил вход!',
        ];
    }
}
