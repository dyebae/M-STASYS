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
            $table->string('tempat_lahir', 30);
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->string('agama', 20);
            $table->string('password', 20);
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
        Schema::dropIfExists('tb_admin_op');
    }
}
