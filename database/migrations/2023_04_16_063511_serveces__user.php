<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('serves_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('price');
            $table->enum('payments',['0','1'])->default('1');
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('idServiseProvider');
            $table->foreign('iduser')->references('id')
            ->on('users_cus')->onDelete('cascade');
            $table->foreign('idServiseProvider')->references('id')
            ->on('sevicePorvider')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serves_user');
    }
};
