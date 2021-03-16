<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->string('tipo_documento',20);
            $table->string('num_documento',20);
            $table->text('direccion');
            $table->string('telefono',20)->nullable();
            $table->string('email',50)->nullable();
            $table->boolean('estado')->default('0');

            // Relación con Empresa
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
        Schema::dropIfExists('clientes');
    }
}
