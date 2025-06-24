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
        Schema::create('room_class_bed_features', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('room_class_id');
            $table->foreign('room_class_id', 'fk_room_class_bed_features_id')->references('id')->on('room_classes')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('feature_id');
            $table->foreign('feature_id', 'fk_feature_id')->references('id')->on('features')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('room_class_bed_features');
    }
};
