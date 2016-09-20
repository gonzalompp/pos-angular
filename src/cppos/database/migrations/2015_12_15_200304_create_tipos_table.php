<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre', 100);
            $table->string('nombre_corto', 50);
            $table->string('tag', 50);
            $table->string('fa_icon', 50);
            $table->string('css_class', 50);
        });
        
        DB::table('tipos')->insert(array(
            array(
                'nombre' => 'Mesa',
                'nombre_corto' => 'Mesa', 
                'tag' => 'mesa', 
                'fa_icon' => 'fa-circle', 
                'css_class' => 'pedido_tipo_mesa'
                ),
            array(
                'nombre' => 'Despacho a domicilio',
                'nombre_corto' => 'Despacho', 
                'tag' => 'despacho', 
                'fa_icon' => 'fa-motorcycle', 
                'css_class' => 'pedido_tipo_despacho'
                ),
            array(
                'nombre' => 'Retiro en local',
                'nombre_corto' => 'Retiro', 
                'tag' => 'retiro', 
                'fa_icon' => 'fa-home', 
                'css_class' => 'pedido_tipo_retiro'
                ),
                array(
                'nombre' => 'Mesa vacía',
                'nombre_corto' => 'Mesa', 
                'tag' => 'mesa_vacia', 
                'fa_icon' => 'fa-circle-thin', 
                'css_class' => 'pedido_tipo_mesa_vacia'
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
        Schema::drop('tipos');
    }
}
