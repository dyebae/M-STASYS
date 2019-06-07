<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_soal', function (Blueprint $table) {
            $table->increments('id_soal');
            $table->string('id_ampu', 5)->index();
            $table->foreign('id_ampu')->references('id_ampu')->on('tb_ampu_mapel');
            $table->text('deskripsi');
            $table->integer('nomer', false, true)->length(5);
            $table->text('soal');
            $table->text('a');
            $table->text('b');
            $table->text('c');
            $table->text('d');
            $table->string('jawaban', 1);
            $table->string('date_create', 50);
            $table->integer('status', false, true)->length(1);
            $table->string('waktu_pengerjaan', 50);
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
        Schema::dropIfExists('tb_soal');
    }
}
