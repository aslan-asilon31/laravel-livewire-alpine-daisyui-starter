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
        Schema::create('tr_pemesanan_penjualan_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tr_pemesanan_penjualan_header_id');
            $table->foreign('tr_pemesanan_penjualan_header_id', 'fk_tr_pemesanan_penjualan_header_id')->references('id')->on('tr_pemesanan_penjualan_header')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('ms_barang_id');
            $table->foreign('ms_barang_id')->references('id')->on('ms_barang')->onDelete('cascade')->onUpdate('cascade');

            $table->text('catatan')->nullable();
            $table->integer('qty');

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
        Schema::dropIfExists('tr_tanda_terima_service_header');
    }
};
