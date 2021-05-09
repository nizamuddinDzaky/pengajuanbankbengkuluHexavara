<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranskasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kantor_id')->unsigned()->nullable();
            $table->foreign('kantor_id')->references('id')->on('kantor');
            $table->bigInteger('pemohon_id')->unsigned()->nullable();
            $table->foreign('pemohon_id')->references('id')->on('users');
            $table->bigInteger('cs_id')->unsigned()->nullable();
            $table->foreign('cs_id')->references('id')->on('users');
            $table->bigInteger('produk_id')->unsigned()->nullable();
            $table->foreign('produk_id')->references('id')->on('produk');
            $table->string('kode_registrasi')->nullable();
            $table->double('max_plafond')->nullable();
            $table->smallInteger('masa_tenor')->nullable();
            $table->double('penghasilan')->nullable();
            $table->double('plafond')->nullable();
            $table->double('suku_bunga')->nullable();
            $table->double('jumlah_angsuran')->nullable();
            $table->mediumText('path_file')->nullable();
            $table->mediumText('biodata')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->text('keperluan_pinjaman')->nullable();
            $table->integer('status')->nullable();
            $table->integer('jumlah_reschedule')->nullable();
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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['kantor_id']);
            $table->dropColumn('kantor_id');
            $table->dropForeign(['pemohon_id']);
            $table->dropColumn('pemohon_id');
            $table->dropForeign(['cs_id']);
            $table->dropColumn('cs_id');
            $table->dropForeign(['produk_id']);
            $table->dropColumn('produk_id');
        });
        Schema::dropIfExists('transaksi');
    }
}
