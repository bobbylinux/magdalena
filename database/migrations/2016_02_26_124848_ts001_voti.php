<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*tabella della registrazione dei voti*/
class Ts001Voti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts001_voti', function (Blueprint $table) {
            $table->integer('c_vot')->unique(); //progressivo del voto per socio
            $table->string('c_soc',10); //codice socio
            $table->string('c_soc_vot',10); //codice del socio votato
            $table->timestamp('d_vot'); //data del socio votato
            $table->integer('c_rif')->unsigned();; //codice data di rifermento in cui si svolge la votazione
            //primary-key
            $table->primary(['c_soc', 'c_vot']);
            //foreign key
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
        Schema::table('ts001_voti', function (Blueprint $table) {
            //
        });
    }
}
