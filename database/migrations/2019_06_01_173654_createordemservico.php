<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createordemservico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servico', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente');
            $table->integer('id_paciente');
            $table->integer('id_servico');
            $table->integer('id_situacao');
            $table->integer('id_grupo_kanban');
            $table->dateTime('data_entrada')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->dateTime('data_previsao_entrega')->nullable();
            $table->integer('quantidade');
            $table->text('hora_previsao_entrega');
            $table->text('cor');
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
        Schema::dropIfExists('ordem_servico');
    }
}


