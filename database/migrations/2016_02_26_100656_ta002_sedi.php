<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*Tabella delle sedi*/
class Ta002Sedi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ta002_sedi', function (Blueprint $table) {
            $table->string('c_sed',3)->unique(); //Codice Sede
            $table->string('t_sed',100)->unique(); //Descrizione Sede
            //primary-key
            $table->primary('c_sed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ta002_sedi', function (Blueprint $table) {
            //
        });
    }
}
