<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kantor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kantor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kantor');
            $table->string('parent')->default('1');
            $table->bigInteger('provinsi_id')->unsigned()->nullable();
            $table->foreign('provinsi_id')->references('id')->on('provinsi');
            $table->bigInteger('kabkot_id')->unsigned()->nullable();
            $table->foreign('kabkot_id')->references('id')->on('kabkot');
            $table->bigInteger('kecamatan_id')->unsigned()->nullable();
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan');
            $table->bigInteger('kelurahan_id')->unsigned()->nullable();
            $table->foreign('kelurahan_id')->references('id')->on('kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kantor', function (Blueprint $table) {
            $table->dropForeign(['provinsi_id']);
            $table->dropColumn('provinsi_id');
            $table->dropForeign(['kabkot_id']);
            $table->dropColumn('kabkot_id');
            $table->dropForeign(['kecamatan_id']);
            $table->dropColumn('kecamatan_id');
            $table->dropForeign(['kelurahan_id']);
            $table->dropColumn('kelurahan_id');
        });
        Schema::dropIfExists('kantor');
    }
}
