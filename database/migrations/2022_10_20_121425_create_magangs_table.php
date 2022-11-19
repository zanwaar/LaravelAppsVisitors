<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('bagian_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->string('sekolah');
            $table->date('tglmulai')->nullable();
            $table->date('tglselesai')->nullable();
            $table->boolean('status')->default(false);
            $table->string('pembimbing');
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
        Schema::dropIfExists('magangs');
    }
}
