<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre', 200);
            $table->integer('orden');
        });
        
        DB::table('categorias')->insert(array(
            array('nombre' => 'Sushi', 'orden' => 1),
            array('nombre' => 'Bebidas', 'orden' => 2),
            array('nombre' => 'Promociones', 'orden' => 3),
            array('nombre' => 'Ensaladas', 'orden' => 4)
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categorias');
    }
}
