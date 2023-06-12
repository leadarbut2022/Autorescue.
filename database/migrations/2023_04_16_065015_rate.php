<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('iduser');
            $table->foreign('iduser')->references('id')
                ->on('users_cus')->onDelete('cascade');
            $table->unsignedBigInteger('idServiseProvider');
            $table->foreign('idServiseProvider')->references('id')
                ->on('sevicePorvider')->onDelete('cascade');
            $table->float('rate')->unsigned();
            $table->text('review')->nullable();
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
        Schema::dropIfExists('rates');
    }
};
