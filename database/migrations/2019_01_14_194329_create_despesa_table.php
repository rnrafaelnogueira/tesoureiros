<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesa', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nome');
            $table->integer('id_categoria');
            $table->integer('id_user');
            $table->float('valor_fixo');
            $table->dateTime('data_recibo');
            $table->foreign('id_categoria')->references('id')->on('categoria');
            $table->foreign('id_user')->references('id')->on('users');            
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
        Schema::dropIfExists('despesa');
    }
}
