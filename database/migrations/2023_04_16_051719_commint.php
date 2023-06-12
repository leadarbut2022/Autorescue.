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
        Schema::create('commint', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contents');
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
        Schema::dropIfExists('commint');
    }
};
