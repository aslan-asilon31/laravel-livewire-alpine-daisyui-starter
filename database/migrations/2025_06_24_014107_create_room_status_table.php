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
        Schema::create('room_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('floor_id');
            $table->foreign('floor_id', 'fk_floor_id')->references('id')->on('floors')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('room_class_id');
            $table->foreign('room_class_id', 'fk_room_statuses_id')->references('id')->on('room_classes')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_statuses');
    }
};
