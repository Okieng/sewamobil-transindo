<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_id');
            $table->foreign('peminjaman_id')->references('id')->on('peminjamans')->onDelete('cascade');
            $table->date('tanggal_pengembalian');
            $table->integer('jumlah_hari');
            $table->string('biaya_sewa');
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
        Schema::dropIfExists('pengembalianss');
    }
}
