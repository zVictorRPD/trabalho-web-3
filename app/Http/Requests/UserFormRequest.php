<?php

namespace App\Http\Requests;

use App\Rules\ValidPassword;
use App\Rules\PasswordRequired;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name' => 'required',
            'cpf' => 'required',
            'birth' => 'required|date_format:d/m/Y',
            'sex' => 'required|in:M,F,O',
            'email' => 'required',
            'password' => [new PasswordRequired, new ValidPassword]
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo Obrigatório',
            'date_format' => 'A data de nascimento deve estar no formato DD/MM/YYYY',
            'in' => 'Selecione um sexo válido',
        ];
    }

    public function validateEmail()
    {

    }
}
