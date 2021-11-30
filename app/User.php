<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    // protected $table = 'itr_psgr';
    // protected $primaryKey = 'CD_PSGR';
    // public $timestamps = false;

    protected $fillable = [
        'name',
        'birth',
        'cpf',
        'sex',
        'email',
        'password',
    ];
}
