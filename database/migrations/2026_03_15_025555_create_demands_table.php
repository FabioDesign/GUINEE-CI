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
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('reference', 50)->unique();
            $table->tinyInteger('number');
            $table->tinyInteger('copy');
            $table->decimal('price', 10, 0);
            $table->text('motif')->nullable();
            $table->text('path')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->timestamp('transmitted_at')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->timestamp('rejeted_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('recovered_at')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('transmitted_by')->nullable();
            $table->foreignId('validated_by')->nullable();
            $table->foreignId('rejeted_by')->nullable();
            $table->foreignId('recovered_by')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('consulat_id');
            $table->foreignId('document_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demands');
    }
};
