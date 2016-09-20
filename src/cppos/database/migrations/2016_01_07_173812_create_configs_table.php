<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->string('codigo', 200);
            $table->string('valor', 500);
        });
        
        DB::table('configs')->insert(array(
            //Sushi
            array(
                'codigo' => 'empresa.nombre', 
                'valor' => 'OM Gastronomía'
                ),
            array(
                'codigo' => 'sucursal.nombre', 
                'valor' => 'Manquehue'
                ),
            array(
                'codigo' => 'sucursal.direccion', 
                'valor' => 'Avda. Manquehue 3452, Las Condes'
                ),
            array(
                'codigo' => 'sucursal.teléfono', 
                'valor' => '+56 02 66987854'
                ),
            array(
                'codigo' => 'sucursal.email', 
                'valor' => 'contacto@omgastronomia.cl'
                ),
            array(
                'codigo' => 'sucursal.codigo', 
                'valor' => 'DS3544G'
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
        Schema::drop('configs');
    }
}
