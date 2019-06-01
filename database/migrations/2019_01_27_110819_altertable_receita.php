<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltertableReceita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receita', function (Blueprint $table) {
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
        Schema::table('receita', function (Blueprint $table) {
            //
        });
    }
}