<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*Tabella dei soci in forze*/
class Ta001Soci extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ta001_soci', function (Blueprint $table) {
            $table->string('c_soc',10)->unique(); //Codice Socio
            $table->string('c_bdg',8)->unique(); //Codice Badge
            $table->string('t_cgn',100); //Cognome Socio
            $table->string('t_nom',100); //Nome Socio
            $table->string('c_cdc',10); //Codice Centro di Costo
            $table->string('c_sed',10); //Codice Sede
            $table->string('c_tip_soc',2); //Tipo socio
            $table->string('f_sgn_in',1)->default("N"); //Flag che indica se utente ha votato o no
            $table->string('f_cnd',1)->default("N"); //Flag che indica se il socio è un candidato (S / N)
            $table->integer('c_rif')->unsigned(); //codice data di rifermento in cui si svolge la votazione
            //primary-key
            $table->primary('c_soc');
            //foreign-key
            $table->foreign('c_sed')->references('c_sed')->on('ta002_sedi');
            $table->foreign('c_cdc')->references('c_cdc')->on('ta003_cdc');
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
        Schema::table('ta001_soci', function (Blueprint $table) {
            //
        });
    }
}
