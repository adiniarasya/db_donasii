<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
        $table->id();

        $table->string('periode'); // contoh: 2026-04
        $table->integer('total_donasi_uang')->default(0);
        $table->integer('total_donasi_barang')->default(0);
        $table->integer('jumlah_donatur')->default(0);

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
        Schema::dropIfExists('laporan');
    }
}
