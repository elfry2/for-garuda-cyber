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
        Schema::create('tenant_purchases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tenant_id')->constrained();
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_purchases');
    }
};
