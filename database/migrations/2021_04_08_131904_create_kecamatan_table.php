<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kabkot_id')->unsigned();
            $table->foreign('kabkot_id')->references('id')->on('kabkot');
            $table->string('kecamatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kecamatan', function (Blueprint $table) {

            $table->dropForeign(['kabkot_id']);
            $table->dropColumn('kabkot_id');
        });
        Schema::dropIfExists('kecamatan');
    }
}
