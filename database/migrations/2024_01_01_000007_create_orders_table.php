<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('delivery_fee', 10, 2)->default(2.99);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['placed', 'preparing', 'out_for_delivery', 'delivered', 'cancelled'])->default('placed');
            $table->enum('payment_method', ['cash', 'online'])->default('cash');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->text('delivery_address');
            $table->string('delivery_phone');
            $table->text('delivery_note')->nullable();
            $table->timestamp('placed_at')->nullable();
            $table->timestamp('preparing_at')->nullable();
            $table->timestamp('out_for_delivery_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
