<?php

namespace App\Http\Requests;

use App\Rules\ValidCPF;
use App\Rules\UniqueCPF;
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
            'name' => 'bail|required',
            'cpf' => ['bail', 'required', 'string', 'size:14', new ValidCPF, new UniqueCPF],
            'birth' => 'bail|required|date_format:d/m/Y',
            'sex' => 'bail|required|in:M,F,O',
            'email' => 'bail|required',
            'password' => ['bail', new PasswordRequired, new ValidPassword]
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo Obrigatório',
            'cpf.size' => 'O CPF deve estar no formato XXX.XXX.XXX-XX',
            'date_format' => 'A data de nascimento deve estar no formato DD/MM/YYYY',
            'in' => 'Selecione um sexo válido',
        ];
    }

    public function validateEmail()
    {

    }
}
