<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ordem_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descricao');
            $table->integer('id_fornecedor');
            $table->integer('id_situacao');
            $table->integer('id_grupo_kanban');
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
        Schema::dropIfExists('ordem_compra');
    }
}
