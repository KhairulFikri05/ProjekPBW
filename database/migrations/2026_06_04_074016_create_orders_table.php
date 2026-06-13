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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Menghubungkan pesanan ke meja mana
            $table->foreignId('table_id')->constrained('tables')->onDelete('cascade');
            $table->integer('total_price')->default(0);
            // Status alur pesanan di kafe
            $table->enum('status', ['menunggu', 'dimasak', 'disajikan', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
