<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kecamatan_id')->unsigned();
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan');
            $table->string('kelurahan')->nullable();
            $table->string('kd_pos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelurahan', function (Blueprint $table) {

            $table->dropForeign(['kecamatan_id']);
            $table->dropColumn('kecamatan_id');
        });
        Schema::dropIfExists('kelurahan');
    }
}
