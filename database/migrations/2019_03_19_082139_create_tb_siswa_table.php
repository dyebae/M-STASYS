<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->string('nis', 10)->primary();
            $table->string('nisn', 20);
            $table->string('no_ijasah_smp', 20);
            $table->string('no_un', 20);
            $table->string('id_kelas', 5)->index();
            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas');
            $table->string('nama', 50);
            $table->string('tempat_lahir', 30);
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->string('agama', 20);
            $table->string('password', 20);
            $table->string('jenis_kelamin', 10);
            $table->string('status', 20);
            $table->string('foto');
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
        Schema::dropIfExists('tb_siswa');
    }
}
