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
        Schema::create('demand_cdi', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('number');
            $table->string('lastname');
            $table->string('firstname');
            $table->date('birthday_at');
            $table->timestamps();
            $table->foreignId('demand_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demand_cdi');
    }
};
