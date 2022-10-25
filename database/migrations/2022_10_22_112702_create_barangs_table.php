<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jenis');
            $table->string('nama');
            $table->string('pengirim');
            $table->string('penerima');
            $table->foreignUuid('bagian_id')->constrained()->cascadeOnDelete();
            $table->string('keterangan');
            $table->date('tglditerima')->nullable();
            $table->date('tgldiambil')->nullable();
            $table->string('diambil');
            $table->boolean('status');
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
        Schema::dropIfExists('barangs');
    }
}
