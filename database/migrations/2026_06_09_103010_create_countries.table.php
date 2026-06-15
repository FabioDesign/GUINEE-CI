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
        Schema::create('countries', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('country', 100);
            $table->string('nationality', 100);
            $table->char('alpha', 2);
            $table->string('code', 10);
            $table->tinyInteger('embassy')->default('0');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};