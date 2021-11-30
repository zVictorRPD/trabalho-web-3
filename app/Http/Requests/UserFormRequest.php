<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassengerFormRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'birth' => 'nullable|date_format:d/m/Y',
            'cpf' => 'nullable',
            'sex' => 'nullable|string|max:1',
            'email' => 'required|string|max:30',
            'password' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo Obrigatório',
            'string' => 'O campo precisa ser um texto válido',
            'name.max' => 'O nome do passageiro deve ter até 30 letras',
            'birth.date_format' => 'A data de nascimento deve seguir o formato DD/MM/YYYY',
        ];
    }
}
