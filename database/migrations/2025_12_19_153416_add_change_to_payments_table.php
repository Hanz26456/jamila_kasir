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
        Schema::table('payments', function (Blueprint $table) {
            // Menambahkan kolom change setelah kolom amount
            // Gunakan decimal agar presisi untuk nilai mata uang
            $table->decimal('change', 12, 2)->default(0)->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn('change');
        });
    }
};