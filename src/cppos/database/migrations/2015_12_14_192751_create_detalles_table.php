<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->integer('id_pedido');
            $table->integer('id_producto');
            $table->integer('cantidad');
            $table->decimal('precio_unitario');
            
            $table->string('nombre_producto');
            
            $table->boolean('eliminado');
            $table->string('eliminado_por',50);
        });
        
        DB::table('detalles')->insert(array(
            //Sushi
            array(
                'id_pedido' => 1, 
                'id_producto' => 1, 
                'nombre_producto' => 'Kanikama Roll', 
                'cantidad' => 3, 
                'precio_unitario'=>1500
                ),
            array(
                'id_pedido' => 1, 
                'id_producto' => 2, 
                'nombre_producto' => 'Mosutoro Roll', 
                'cantidad' => 3, 
                'precio_unitario'=>1600
                ),
            array(
                'id_pedido' => 1, 
                'id_producto' => 3,
                'nombre_producto' => 'Abocado Roll',  
                'cantidad' => 5, 
                'precio_unitario'=>1700
                )
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('detalles');
    }
}
