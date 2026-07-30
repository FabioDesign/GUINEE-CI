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
        Schema::create('annual_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->year('years', 4);
            $table->decimal('amount', 15, 0);
            $table->decimal('number', 10, 0);
            $table->decimal('paid', 10, 0);
            $table->decimal('free', 10, 0);
            $table->datetime('created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreignId('consulat_id');
            $table->foreignId('document_id');
            $table->unique(['consulat_id', 'document_id', 'years']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_stats');
    }
};
