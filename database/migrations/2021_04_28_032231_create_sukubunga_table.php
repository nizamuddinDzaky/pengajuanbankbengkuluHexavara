<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSukubungaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suku_bunga', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dari_bulan')->nullable();
            $table->integer('sampai_bulan')->nullable();
            $table->double('bunga')->nullable();
            $table->bigInteger('produk_id')->unsigned()->nullable();
            $table->foreign('produk_id')->references('id')->on('produk');
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
        Schema::table('suku_bunga', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->dropColumn('produk_id');
        });
        Schema::dropIfExists('suku_bunga');
    }
}
