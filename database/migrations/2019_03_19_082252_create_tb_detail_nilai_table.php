<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDetailNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_nilai', function (Blueprint $table) {
            $table->string('id_detail', 5)->primary();
            $table->string('jenis_nilai', 30);
            $table->enum('kategori_nilai', ['ph', 'pts', 'pas']);
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
        Schema::dropIfExists('tb_detail_nilai');
    }
}
