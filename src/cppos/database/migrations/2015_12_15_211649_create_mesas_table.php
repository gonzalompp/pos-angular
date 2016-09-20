<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->string('nombre', 200);
            $table->integer('puestos');
            $table->text('observaciones');
        });
        
        DB::table('mesas')->insert(array(
            //Sushi
            array('nombre' => 'Mesa #1', 'puestos' => 5),
            array('nombre' => 'Mesa #2', 'puestos' => 5),
            array('nombre' => 'Mesa #3', 'puestos' => 5),
            array('nombre' => 'Mesa #4', 'puestos' => 5),
            array('nombre' => 'Mesa #5', 'puestos' => 5),
            array('nombre' => 'Mesa #6', 'puestos' => 5),
            array('nombre' => 'Mesa #7', 'puestos' => 5)
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mesas');
    }
}
