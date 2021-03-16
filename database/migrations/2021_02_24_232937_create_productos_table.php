<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('nombre',200);
            $table->integer('stock');
            $table->string('descripcion');
            $table->float('precio_unitario');
            // $table->String('unidad_medida');
            $table->boolean('estado')->default('0');

            $table->unsignedBigInteger('empresaId');
            $table->foreign('empresaId')->references('id')->on('empresas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
