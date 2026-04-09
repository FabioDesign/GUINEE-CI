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
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('transmitted_at')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->integer('document_id');
            $table->integer('created_by');
            $table->integer('updated_by')->default('0');
            $table->integer('deleted_by')->default('0');
            $table->integer('validated_id')->default('0');
            $table->integer('transmitted_id')->default('0');
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
