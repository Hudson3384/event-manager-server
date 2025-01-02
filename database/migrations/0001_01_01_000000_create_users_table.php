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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // Changed to nullable()
            $table->string('google_id'); // Added
            $table->string('avatar')->nullable(); // Added
            $table->foreignId('company_id')->nullable();
            $table->integer('level')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->foreignId('company_id');
            $table->longText('cover_image_link');
            $table->longText('description');
            $table->double('price');
            $table->timestamps();
        });

        Schema::create('event_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_user');
    }
};
