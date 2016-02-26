<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*tabella dei centri di costo*/
class Ta003Cdc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ta003_cdc', function (Blueprint $table) {
            $table->string('c_cdc',3); 
            $table->string('t_sed',100); 
            //primary-key
            $table->primary('c_cdc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ta003_cdc');
    }
}
