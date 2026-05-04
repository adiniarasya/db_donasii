<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjemputanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjemputan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('donasi_id')->constrained('donasi');

        $table->foreignId('kurir_id')->constrained('users');

        $table->text('alamat_jemput');
        $table->date('tanggal_jemput');

        $table->string('status')->default('menunggu');

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
        Schema::dropIfExists('penjemputan');
    }
}
