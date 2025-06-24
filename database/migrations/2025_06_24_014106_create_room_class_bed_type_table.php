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
        Schema::create('room_class_bed_types', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('room_class_id');
            $table->foreign('room_class_id', 'fk_room_class_bed_types_id')->references('id')->on('room_classes')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('bed_type_id');
            $table->foreign('bed_type_id', 'fk_bed_type_id')->references('id')->on('bed_types')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('num_beds');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_class_bed_types');
    }
};
