<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id'); //chiave primaria
            $table->string('username', 128)->unique(); //nome utente con standard email es: email@email.com
            $table->string('password', 64); //password che verrà crittografata secondo gestione di laravel
            $table->boolean('admin')->default(false);
            $table->boolean('active')->default(true);
            $table->rememberToken();//set del token che permette di ricordare la sessione utente
            $table->string('c_soc',10);
            $table->timestamps();

            $table->foreign('c_soc')->references('c_soc')->on('ta001_soci');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
