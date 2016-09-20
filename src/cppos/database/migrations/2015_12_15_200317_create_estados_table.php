<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre', 50);
        });
        
        DB::table('estados')->insert(array(
            //Sushi
            array('nombre' => 'Pendiente'),
            array('nombre' => 'Pagado'),
            array('nombre' => 'Eliminado'),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estados');
    }
}
