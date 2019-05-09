<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_guru', function (Blueprint $table) {
            $table->string('nip', 20)->primary();
            $table->string('walikelas', 10);
            $table->string('nama', 50);
            $table->string('tempat_lahir', 30);
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->integer('id_agama', false, true)->length(11)->index();
            $table->foreign('id_agama')->references('id_agama')->on('tb_agama');
            $table->string('password', 100);
            $table->string('jenis_kelamin', 10);
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
        Schema::dropIfExists('tb_guru');
    }
}
