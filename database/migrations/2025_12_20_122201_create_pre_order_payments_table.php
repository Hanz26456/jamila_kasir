<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pre_order_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pre_order_id')->constrained()->onDelete('cascade');
            $table->enum('payment_type', ['dp', 'full_payment', 'remaining_payment', 'refund']);
            $table->enum('payment_method', ['cash', 'qris', 'bank_transfer']);
            $table->decimal('amount', 10, 2);
            $table->decimal('change', 10, 2)->default(0);
            $table->string('proof_image')->nullable()->comment('Bukti transfer untuk bank_transfer');
            $table->text('notes')->nullable();
            $table->dateTime('paid_at');
            $table->foreignId('processed_by')->constrained('users')->comment('User yang memproses pembayaran');
            $table->timestamps();
            
            $table->index('paid_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_order_payments');
    }
};
