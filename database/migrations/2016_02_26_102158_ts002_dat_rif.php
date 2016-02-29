<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*elenco parametri*/
class Ts002DatRif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts002_dat_rif', function (Blueprint $table) {
            $table->increments('c_rif'); //codice data di riferimento
            $table->timestamp('d_rif_ini'); //inizio data di riferimento
            $table->timestamp('d_rif_fin'); //fine data di riferimento
            $table->string('t_des',500)->nullable(); //data di riferimento (???)
            $table->string('f_att',1)->default("N"); //flag che indica quale data è attiva
            //primary-key
            $table->primary('c_rif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ts002_dat_rif');
    }
}