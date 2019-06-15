<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFaturaOrdemServico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('fatura_ordem_servico', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_fatura');
            $table->integer('id_ordem_servico');
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
        Schema::dropIfExists('fatura_ordem_servico');
    }
}
