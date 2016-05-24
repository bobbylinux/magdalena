<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*Tabella dei candidati per votazione*/
class Ts004Candidati extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts004_candidati', function (Blueprint $table) {
            $table->increments('id'); //chiave primaria
            $table->string('c_soc',10)->unique(); //Codice Socio
            $table->integer('c_rif')->unsigned(); //codice data di rifermento in cui si svolge la votazione
            //unique
            $table->unique(array('c_soc', 'c_rif'));
            //foreign-key
            $table->foreign('c_rif')->references('c_rif')->on('ts002_dat_rif');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ts004_candidati', function (Blueprint $table) {
            //
        });
    }
}
