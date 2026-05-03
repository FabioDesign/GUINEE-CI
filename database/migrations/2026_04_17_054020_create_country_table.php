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
        Schema::create('country', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('libelle', 100);
            $table->char('alpha', 2);
            $table->string('code', 10);
            $table->tinyInteger('embassy');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('country');
    }
};