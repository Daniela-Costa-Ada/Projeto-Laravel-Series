<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesFav extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritas', function (Blueprint $table) {
            $table->integer('usuario_id');
            $table->integer('serie_id');
            $table->foreign('usuario_id')
            ->references('id')
            ->on('users');
            $table->foreign('serie_id')
            ->references('id')
            ->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favoritas', function (Blueprint $table) {
            //
        });
    }
}
