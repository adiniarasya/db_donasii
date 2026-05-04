<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donasi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();

        $table->enum('jenis_donasi', ['uang', 'barang']);

        // uang
        $table->integer('nominal')->nullable();

        // barang
        $table->string('nama_barang')->nullable();
        $table->integer('jumlah_barang')->nullable();
        $table->string('kondisi')->nullable();

        $table->text('deskripsi')->nullable();
        $table->string('status')->default('pending');
        $table->date('tanggal');

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
        Schema::dropIfExists('donasi');
    }
}
