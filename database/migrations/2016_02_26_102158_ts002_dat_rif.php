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
            $table->integer('n_vot_min')->default('1'); //numero di voti validi)
            $table->integer('n_vot_max')->default('9'); //numero di voti validi
            $table->string('f_att',1)->default("N"); //flag che indica quale data è attiva
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
