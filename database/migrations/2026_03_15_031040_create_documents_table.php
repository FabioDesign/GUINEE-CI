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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid');
            $table->string('icone', 50);
            $table->string('libelle', 255);
            $table->string('amount', 50);
            $table->integer('number');
            $table->text('description');
            $table->tinyInteger('position')->default('0');
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->integer('period_id');
            $table->integer('created_by');
            $table->integer('updated_by')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
