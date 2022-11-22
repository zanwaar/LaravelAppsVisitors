<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingpermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workingpermits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('mitra');
            $table->string('nowp');
            $table->string('nama');
            $table->string('tlpn');
            $table->string('titikkor');
            $table->string('judulpekerjaan');
            $table->string('lokasi');
            $table->date('tglawal')->nullable();
            $table->date('tglakhir')->nullable();
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
        Schema::dropIfExists('workingpermits');
    }
}
