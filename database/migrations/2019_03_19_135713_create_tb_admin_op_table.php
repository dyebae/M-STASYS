<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbAdminOpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_admin_op', function (Blueprint $table) {
            $table->string('username', 10)->primary();
            $table->string('nama', 50);
            $table->string('tempat_lahir', 30)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('id_agama', false, true)->length(11)->index()->nullable()->nullable();
            $table->foreign('id_agama')->references('id_agama')->on('tb_agama');
            $table->string('password', 100);
            $table->string('jenis_kelamin', 10)->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('tb_admin_op');
    }
}
