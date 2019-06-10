<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbAmpuMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ampu_mapel', function (Blueprint $table) {
            $table->string('id_ampu', 5)->primary();
            $table->string('nip', 20)->index();
            $table->foreign('nip')->references('nip')->on('tb_guru');
            $table->string('id_mapel', 5)->index();
            $table->foreign('id_mapel')->references('id_mapel')->on('tb_mapel');
            $table->string('id_kelas', 10)->index();
            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas');
            $table->string('id_kategori', 5)->index();
            $table->foreign('id_kategori')->references('id_kategori')->on('tb_kategori_mapel');
            $table->string('id_semester', 10)->index();
            $table->foreign('id_semester')->references('id_semester')->on('tb_semester');
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
        Schema::dropIfExists('tb_ampu_mapel');
    }
}
