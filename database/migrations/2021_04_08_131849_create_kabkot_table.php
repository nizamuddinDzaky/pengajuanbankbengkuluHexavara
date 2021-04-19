<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKabkotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kabkot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('provinsi_id')->unsigned();
            $table->foreign('provinsi_id')->references('id')->on('provinsi');
            $table->string('kabupaten_kota')->nullable();
            $table->string('ibukota')->nullable();
            $table->string('k_bsni')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kabkot', function (Blueprint $table) {

            $table->dropForeign(['provinsi_id']);
            $table->dropColumn('provinsi_id');
        });
        Schema::dropIfExists('kabkot');
    }
}
