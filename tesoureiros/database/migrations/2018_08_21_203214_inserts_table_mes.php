<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertsTableMes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('mes')->insert(['descricao' => 'Janeiro']);
        DB::table('mes')->insert(['descricao' => 'Fevereiro']);
        DB::table('mes')->insert(['descricao' => 'Março']);
        DB::table('mes')->insert(['descricao' => 'Abril']);
        DB::table('mes')->insert(['descricao' => 'Maio']);
        DB::table('mes')->insert(['descricao' => 'Junho']);
        DB::table('mes')->insert(['descricao' => 'Julho']);
        DB::table('mes')->insert(['descricao' => 'Agosto']);
        DB::table('mes')->insert(['descricao' => 'Setembro']);
        DB::table('mes')->insert(['descricao' => 'Outubro']);
        DB::table('mes')->insert(['descricao' => 'Novembro']);
        DB::table('mes')->insert(['descricao' => 'Dezembro']);
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
