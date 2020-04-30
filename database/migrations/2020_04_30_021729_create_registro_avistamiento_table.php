<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroAvistamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_avistamiento', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date',0);
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animal')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_avistamiento');
    }
}
