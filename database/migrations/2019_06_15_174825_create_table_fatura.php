<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFatura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente');
            $table->dateTime('data_geracao')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->text('referencia');
            $table->char('enviada', 1)->default('N');
            $table->char('baixada', 1)->default('N');
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
        Schema::dropIfExists('fatura');
    }
}
