<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'birth',
        'cpf',
        'sex',
        'email',
        'password',
    ];

    protected $hidden = [
        'id',
        'password',
        'created_at',
        'updated_at',
    ];
}
