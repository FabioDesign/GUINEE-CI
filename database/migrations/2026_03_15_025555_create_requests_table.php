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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid');
            $table->string('code', 50)->unique();
            $table->date('daterdv_at');
            $table->text('motif')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('transmitted_at')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->timestamp('rejeted_at')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
            $table->integer('transmitted_by')->default('0');
            $table->integer('validated_by')->default('0');
            $table->integer('rejeted_by')->default('0');
            $table->integer('document_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
