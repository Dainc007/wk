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
        Schema::create('team_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('status')->nullable();
            $table->string('pitch_role')->nullable();
            $table->dateTime('contract_signed_at')->nullable();
            $table->dateTime('contract_terminated_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_user');
    }
};
