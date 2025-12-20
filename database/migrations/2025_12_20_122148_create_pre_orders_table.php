<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            // Order Info
            $table->string('order_number', 50)->unique()->comment('Format: PO-YYYYMMDD-0001');
            $table->dateTime('order_date');
            $table->dateTime('delivery_date')->comment('Tanggal pengambilan/pengiriman');
            $table->enum('order_type', ['custom_cake', 'pre_order', 'catering'])->default('pre_order');
            $table->enum('status', ['pending', 'confirmed', 'in_production', 'ready', 'completed', 'canceled'])->default('pending');
            
            // Custom Product Details
            $table->string('product_name')->comment('Nama produk custom');
            $table->text('description')->nullable()->comment('Deskripsi detail pesanan');
            $table->json('specifications')->nullable()->comment('Spesifikasi: ukuran, bentuk, rasa, topping, dll');
            $table->text('design_notes')->nullable()->comment('Catatan desain/tulisan di kue');
            $table->string('reference_image')->nullable()->comment('Path foto referensi');
            
            // Pricing
            $table->integer('quantity')->default(1);
            $table->decimal('price_per_unit', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->decimal('dp_amount', 10, 2)->default(0)->comment('Down Payment');
            $table->integer('dp_percentage')->default(50)->comment('Persentase DP (default 50%)');
            $table->decimal('remaining_payment', 10, 2)->default(0)->comment('Sisa pembayaran');
            $table->enum('payment_status', ['unpaid', 'dp_paid', 'paid', 'refunded'])->default('unpaid');
            
            // Delivery
            $table->enum('delivery_method', ['pickup', 'delivery'])->default('pickup');
            $table->text('delivery_address')->nullable();
            $table->decimal('delivery_fee', 10, 2)->default(0);
            
            // Additional Notes
            $table->text('admin_notes')->nullable()->comment('Catatan internal admin');
            $table->text('customer_notes')->nullable()->comment('Catatan dari customer');
            $table->text('cancellation_reason')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('delivery_date');
            $table->index('status');
            $table->index('payment_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_orders');
    }
};
