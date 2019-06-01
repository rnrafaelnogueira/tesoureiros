<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableReceita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receita', function (Blueprint $table) {
            $table->foreign('tipo_receita')->references('id')->on('tipo_receita');
            $table->foreign('mes')->references('id')->on('mes');
            $table->integer('ano')->nullable();
            $table->integer('nome')->nullable();
            $table->dateTime('data_recibo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
