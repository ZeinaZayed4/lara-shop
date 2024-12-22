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
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('payment_method')->default(1);
            $table->string('payment_status')->default(1)->nullable();
            $table->longText('address')->nullable();
            $table->longText('notes')->nullable();
            $table->float('subtotal');
            $table->float('vat');
            $table->double('total');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
