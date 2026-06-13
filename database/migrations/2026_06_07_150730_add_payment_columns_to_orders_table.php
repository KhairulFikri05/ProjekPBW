<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Status khusus pembayaran
            $table->enum('payment_status', ['unpaid', 'paid', 'failed'])->default('unpaid')->after('status');
            // Menyimpan kode unik dari Midtrans untuk pop-up pembayaran
            $table->string('snap_token')->nullable()->after('payment_status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'snap_token']);
        });
    }
};
