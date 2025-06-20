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
        Schema::create('ms_pegawai', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('ms_jabatan_id')->nullable();
            $table->foreign('ms_jabatan_id', 'fk_ms_jabatan_id')->references('id')->on('ms_jabatan')->onDelete('cascade')->onUpdate('cascade');

            $table->string('nama', 255)->nullable();
            $table->string('no_telepon', 30)->nullable();
            $table->text('alamat')->nullable();
            $table->text('kode_pos')->nullable();
            $table->string('image_url')->nullable();
            $table->string('dibuat_oleh', 255)->nullable()->index();
            $table->string('diupdate_oleh', 255)->nullable()->index();
            $table->timestamp('tgl_dibuat');
            $table->timestamp('tgl_diupdate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_pegawai');
    }
};
