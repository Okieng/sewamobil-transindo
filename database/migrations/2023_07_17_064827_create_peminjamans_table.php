<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobil_id');
            $table->foreign('mobil_id')->references('id')->on('mobils')->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->date('tanggal_pengembalian')->nullable();
            $table->integer('jumlah_hari')->nullable();
            $table->string('biaya_sewa')->nullable();
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
        Schema::dropIfExists('peminjamans');
    }
}
