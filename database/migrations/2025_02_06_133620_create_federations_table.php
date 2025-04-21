<?php

declare(strict_types=1);

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
        Schema::create('federations', function (Blueprint $table) {
            // ['domestic', 'continental', 'international']
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('region');

            $table->unique(['region', 'name']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('federations');
    }
};
