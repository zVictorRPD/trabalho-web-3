<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCPF implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cpf = preg_replace('/[^0-9]/', '', $value);

        return substr_count($cpf, $cpf[0]) !== 11;

        $base_digits = substr($cpf, 0, 9);
        $verifier_digits = '';

        $sum = 0;

        for($pos = 0; $pos < 9; $pos++) {
            $digit = (int) $cpf[$pos];
            $sum += (10 - $pos) * $digit;
        }

        $mod = $sum % 11;

        $verifier_digits .= $mod == 0 || $mod == 1 ? '0' : (string) (11 - $mod);

        $sum = 0;

        for($pos = 0; $pos < 10; $pos++) {
            $digit = (int) $cpf[$pos];
            $sum += (11 - $pos) * $digit;
        }

        $mod = $sum % 11;

        $verifier_digits .= $mod == 0 || $mod == 1 ? '0' : (string) (11 - $mod);

        $valid_cpf = $base_digits.$verifier_digits;

        return $cpf === $valid_cpf;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CPF inválido';
    }
}
