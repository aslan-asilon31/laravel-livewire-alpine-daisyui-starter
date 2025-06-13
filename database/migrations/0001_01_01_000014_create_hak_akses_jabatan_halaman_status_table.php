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
        Schema::create('hak_akses_jabatan_halaman_status', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('hak_akses_jabatan_halaman_id');
            $table->foreign('hak_akses_jabatan_halaman_id', 'fk_hak_akses_jabatan_halaman_id')->references('id')->on('hak_akses_jabatan_halaman')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('ms_status_id');
            $table->foreign('ms_status_id')->references('id')->on('ms_status')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('nomor');
            $table->string('dibuat_oleh', 255)->nullable()->index();
            $table->string('diupdate_oleh', 255)->nullable()->index();
            $table->timestamp('tgl_dibuat');
            $table->timestamp('tgl_diupdate');
            $table->string('status')->index()->default('aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hak_akses_jabatan_halaman_status');
    }
};
