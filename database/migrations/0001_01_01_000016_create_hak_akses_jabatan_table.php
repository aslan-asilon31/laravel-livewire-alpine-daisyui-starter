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
        Schema::create('hak_akses_jabatan', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('ms_jabatan_id');
            $table->foreign('ms_jabatan_id', 'ms_jabatan_id')->references('id')->on('ms_jabatan')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('hak_akses_id');
            $table->foreign('hak_akses_id', 'fk_hak_akses_id')->references('id')->on('hak_akses')->onDelete('cascade')->onUpdate('cascade');

            $table->string('dibuat_oleh', 255)->nullable()->index();
            $table->string('diupdate_oleh', 255)->nullable()->index();
            $table->timestamp('tgl_dibuat');
            $table->timestamp('tgl_diupdate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hak_akses_jabatan');
    }
};
