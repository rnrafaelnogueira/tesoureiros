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
            $table->text('recibo');
            $table->integer('id_despesa');
            $table->integer('mes');
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
