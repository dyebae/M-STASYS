<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbHasilSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hasil_soal', function (Blueprint $table) {
            $table->increments('id_soal');
            $table->string('nis', 10)->index();
            $table->foreign('nis')->references('nis')->on('tb_siswa');
            $table->string('benar', 3);
            $table->string('salah', 3);
            $table->string('nilai', 3);
            $table->string('date_soal', 50);
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
        Schema::dropIfExists('tb_hasil_soal');
    }
}
