<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre', 200);
            $table->integer('orden');
            $table->integer('categoria_id');
            $table->decimal('precio');
        });
        
        DB::table('productos')->insert(array(
            //Sushi
            array('nombre' => 'Kanikama Roll', 'orden' => 1, 'categoria_id' => 1, 'precio'=>4500),
            array('nombre' => 'Mosutoro Roll', 'orden' => 2, 'categoria_id' => 1, 'precio'=>5500),
            array('nombre' => 'Abocado Roll', 'orden' => 3, 'categoria_id' => 1, 'precio'=>6600),
            //Bebidas
            array('nombre' => 'Cocacola', 'orden' => 1, 'categoria_id' => 2, 'precio'=>1500),
            array('nombre' => 'Fanta', 'orden' => 2, 'categoria_id' => 2, 'precio'=>1500),
            array('nombre' => 'Sprite', 'orden' => 3, 'categoria_id' => 2, 'precio'=>1500),
            array('nombre' => 'Jugo Natural', 'orden' => 3, 'categoria_id' => 2, 'precio'=>2500),
            //Promociones
            array('nombre' => 'Promo 4 Rolls', 'orden' => 1, 'categoria_id' => 3, 'precio'=>12000),
            array('nombre' => 'Promo 8 Rolls', 'orden' => 2, 'categoria_id' => 3, 'precio'=>20000),
            array('nombre' => 'Promo 10 Rolls', 'orden' => 3, 'categoria_id' => 3, 'precio'=>23000),
            //Ensaladas
            array('nombre' => 'Chilena', 'orden' => 1, 'categoria_id' => 4, 'precio'=>4500),
            array('nombre' => 'Tomate', 'orden' => 2, 'categoria_id' => 4, 'precio'=>2000),
            array('nombre' => 'Lechuga', 'orden' => 3, 'categoria_id' => 4, 'precio'=>2300),
            array('nombre' => 'Repollo', 'orden' => 3, 'categoria_id' => 4, 'precio'=>2650)
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productos');
    }
}
