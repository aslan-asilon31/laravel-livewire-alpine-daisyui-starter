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
        Schema::create('booking_rooms', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('booking_id');
            $table->foreign('booking_id', 'fk_booking_rooms_id')->references('id')->on('bookings')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('payment_status_id');
            $table->foreign('payment_status_id', 'fk_payment_status_id')->references('id')->on('payment_statuses')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_rooms');
    }
};
