<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroReclamoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_reclamo', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date',0);
            $table->unsignedBigInteger('reclamo_id');
            $table->timestamps();

            $table->foreign('reclamo_id')->references('id')->on('reclamo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_reclamo');
    }
}
