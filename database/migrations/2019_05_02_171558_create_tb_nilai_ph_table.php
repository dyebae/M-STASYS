<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbNilaiPhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_nilai_ph', function (Blueprint $table) {
            $table->increments('id_nilai');
            $table->string('nis', 10)->index();
            $table->foreign('nis')->references('nis')->on('tb_siswa');
            $table->string('id_ampu', 5)->index();
            $table->foreign('id_ampu')->references('id_ampu')->on('tb_ampu_mapel');
            $table->string('id_detail', 5)->index();
            $table->foreign('id_detail')->references('id_detail')->on('tb_detail_nilai');
            $table->integer('nilai', false, true)->length(3);
            $table->string('date_create', 50);
            $table->string('date_update', 50);
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
        Schema::dropIfExists('tb_nilai_ph');
    }
}
