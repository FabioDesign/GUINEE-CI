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
            $table->uuid('uid');
            $table->string('lastname', 255);
            $table->string('firstname', 255);
            $table->string('gender', 1);
            $table->string('number', 20)->unique();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->timestamp('password_at')->nullable();
            $table->date('birthday_at');
            $table->string('birthplace', 255);
            $table->string('size', 255);
            $table->string('hair', 255);
            $table->string('complexion', 255);
            $table->string('profession', 255);
            $table->string('father_fullname', 255);
            $table->string('mother_fullname', 255);
            $table->string('person_fullname', 255);
            $table->string('person_number', 255);
            $table->string('person_address', 255);
            $table->string('month', 20);
            $table->year('year');
            $table->string('stamp', 20)->nullable();
            $table->string('signature', 20)->nullable();
            $table->string('avatar', 20)->nullable();
            $table->timestamp('login_at')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->integer('town_id');
            $table->integer('activated_id')->default('0');
            $table->integer('blocked_id')->default('0');
            $table->integer('profile_id')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
