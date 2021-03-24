<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_gajis', function (Blueprint $table) {
            $table->increments('idhistori_gaji');
            $table->string('user');
            $table->string('tanggal');
            $table->string('gaji_pokok');
            $table->string('tunjangan');
            $table->string('potongan');
            $table->string('rekening');
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
        Schema::dropIfExists('histori_gajis');
    }
}
