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

        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'fk_role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('payment_status_id');
            $table->foreign('payment_status_id', 'fk_bookings_payment_status_id')->references('id')->on('payment_statuses')->onDelete('cascade')->onUpdate('cascade');

            $table->datetime('checkin_date');
            $table->datetime('checkout_date');
            $table->integer('num_adults');
            $table->integer('num_children');
            $table->string('booking_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
