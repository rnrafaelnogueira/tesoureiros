<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento', function (Blueprint $table) {
            $table->increments('id');
            $table->float('valor');
            $table->text('descricao')->nullable();
            $table->dateTime('data_recibo');
            $table->text('recibo')->nullable();
            $table->integer('id_despesa')->nullable();
            $table->integer('mes')->nullable();
            $table->foreign('id_despesa')->references('id')->on('despesa');      
            $table->foreign('mes')->references('id')->on('mes');
            $table->dateTime('data_cadastro')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
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
        Schema::dropIfExists('pagamento');
    }
}
