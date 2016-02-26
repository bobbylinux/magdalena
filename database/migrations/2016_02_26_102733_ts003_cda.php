<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*tabella contenente i soci nel cda in un periodo*/
class Ts003Cda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts003_cda', function (Blueprint $table) {
            $table->date('d_ini_val'); //data inizio validità carica
            $table->date('d_fin_val')->nullable(); //data fine validita carica
            $table->string('c_soc',10); //socio in carica nel cda
            $table->integer('n_vot'); //numero di voti
            //primary-key
            $table->primary(['d_ini_val', 'c_soc']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ts003_cda');
    }
}
