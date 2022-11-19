<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogtamusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logtamus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tamu_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('bagian_id')->constrained()->cascadeOnDelete();
            $table->string('keperluan');
            $table->dateTime('checkin');
            $table->dateTime('checkout')->nullable();
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
        Schema::dropIfExists('logtamus');
    }
}
