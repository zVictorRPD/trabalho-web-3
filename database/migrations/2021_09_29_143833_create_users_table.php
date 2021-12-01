<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('cpf', 15);
            $table->date('birth');
            $table->string('sex');
            $table->string('email');
            $table->string('password');

            $table->timestamps();
        });

        User::create([
            'name' => 'Pedro Raposo Felix de Sousa',
            'cpf' => '732.457.140-92',
            'birth' => '2000-08-14',
            'sex' => 'M',
            'email' => 'pedro@raposo.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Victor de Oliveira Martins Azevedo',
            'cpf' => '305.984.880-73',
            'birth' => '2000-12-28',
            'sex' => 'M',
            'email' => 'victor@martins.com',
            'password' => bcrypt('123456'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
