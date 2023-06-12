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
    Schema::create('users_cus', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        
        $table->string('password');
        $table->string('phone');
        $table->string('location');
        $table->unsignedInteger('city_id');
        $table->string('image')->nullable();
        $table->string('reset_password_code')->nullable();
        $table->string('code_expiration')->nullable();
        $table->string('fcm_token')->nullable();
        $table->enum('status',['0','1'])->default('1');
        $table->string('is_verified');
        $table->string('remember_token');

        $table->rememberToken();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_cus');
    }
};
