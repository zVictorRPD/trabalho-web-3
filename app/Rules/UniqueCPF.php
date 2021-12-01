<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class UniqueCPF implements Rule
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
        $id = request()->_id;
        
        if(isset($id) && User::find($id)->cpf === $value) {
            return true;
        }
                 
        return is_null(User::firstWhere('cpf', $value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Este CPF já está em uso';
    }
}
