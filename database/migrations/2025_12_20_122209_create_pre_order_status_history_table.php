<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pre_order_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pre_order_id')->constrained()->onDelete('cascade');
            $table->enum('old_status', ['pending', 'confirmed', 'in_production', 'ready', 'completed', 'canceled'])->nullable();
            $table->enum('new_status', ['pending', 'confirmed', 'in_production', 'ready', 'completed', 'canceled']);
            $table->text('notes')->nullable();
            $table->foreignId('changed_by')->constrained('users');
            $table->dateTime('changed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_order_status_history');
    }
};
