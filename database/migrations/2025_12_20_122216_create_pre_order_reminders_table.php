<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pre_order_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pre_order_id')->constrained()->onDelete('cascade');
            $table->enum('reminder_type', ['production_start', 'pickup_reminder', 'payment_reminder']);
            $table->dateTime('reminder_date');
            $table->boolean('is_sent')->default(false);
            $table->dateTime('sent_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('reminder_date');
            $table->index('is_sent');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_order_reminders');
    }
};