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
            $table->string('code', 5);
            $table->string('civility', 5);
            $table->string('lastname', 255);
            $table->string('firstname', 255);
            $table->string('gender', 1);
            $table->string('number', 20)->unique();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->timestamp('password_at')->nullable();
            $table->date('birthday_at');
            $table->string('birthplace', 255);
            $table->string('size', 255)->nullable();
            $table->string('hairs', 255)->nullable();
            $table->string('complexion', 255)->nullable();
            $table->string('profession', 255)->nullable();
            $table->string('home_address', 255)->nullable();
            $table->string('particular_sign', 255)->nullable();
            $table->string('father_fullname', 255)->nullable();
            $table->string('mother_fullname', 255)->nullable();
            $table->string('person_fullname', 255)->nullable();
            $table->string('person_number', 255)->nullable();
            $table->string('person_address', 255)->nullable();
            $table->date('arrival_at')->nullable();
            $table->text('avatar')->nullable();
            $table->text('stamp')->nullable();
            $table->text('signature')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
            $table->foreignId('blocked_by')->nullable();
            $table->foreignId('activated_by')->nullable();
            $table->integer('town_id');
            $table->integer('profile_id')->default('0');
            $table->integer('embassy_id')->default('0');
            $table->integer('nationality_id');
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
