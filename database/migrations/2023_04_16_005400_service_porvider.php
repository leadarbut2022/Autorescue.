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
        Schema::create('sevicePorvider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('texRecord');
            $table->string('centerName');
            $table->string('Regestrion_number');
            $table->string('phone');
            $table->string('password');
            $table->string('location');
            $table->string('image')->nullable();
            $table->string('reset_password_code')->nullable();
            $table->string('code_expiration')->nullable();
            $table->string('fcm_token')->nullable();
            $table->enum('status',['0','1'])->default('1');
            $table->string('is_verified');
            $table->rememberToken();
            $table->string('remember_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sevicePorvider');
    }
};
