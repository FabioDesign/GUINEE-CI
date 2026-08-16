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
        Schema::create('monthly_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('months');
            $table->year('years', 4);
            $table->decimal('amount', 15, 0)->default(0);
            $table->integer('paid')->default(0);
            $table->integer('free')->default(0);
            $table->integer('recover')->default(0);
            $table->datetime('created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreignId('consulat_id');
            $table->foreignId('document_id');
            $table->unique(['consulat_id', 'document_id', 'months', 'years']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_stats');
    }
};
