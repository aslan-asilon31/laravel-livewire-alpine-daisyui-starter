<?php

namespace App\Policies;

use App\Models\MsPegawaiAkun;
use App\Models\HakAkses;
use App\Models\HakAksesJabatanStatus;
use Spatie\Permission\Models\Permission;
use App\Models\HakAksesPegawaiCabang;
use App\Models\RoleAksesStatus;
use App\Models\HakAksesJabatan;
use App\Models\TrPemesananPenjualanHeader;

class HakAksesKebijakan
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function daftar(MsPegawaiAkun $msPegawaiAkun, $halamanId): bool
    {
        return HakAksesJabatan::where('ms_jabatan_id', \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->msJabatan->id)
            ->where('hak_akses_id', $halamanId)->exists();
    }

    public function buat(MsPegawaiAkun $msPegawaiAkun, $halamanId): bool
    {
        return HakAksesJabatan::where('ms_jabatan_id', \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->msJabatan->id)
            ->where('hak_akses_id', $halamanId)->exists();
    }

    public function simpan(MsPegawaiAkun $msPegawaiAkun, $halamanId, $cabangId, $statusId): bool
    {
        $adakahPermission = HakAksesJabatan::where('ms_jabatan_id', \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->msJabatan->id)
            ->where('hak_akses_id', $halamanId)->first();

        if (!$adakahPermission) {
            return false;
        }

        $adakahAksesCabang = HakAksesPegawaiCabang::where('ms_pegawai_id', \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->id)
            ->where('ms_cabang_id', $cabangId)->first();
        if (!$adakahAksesCabang) {
            return false;
        }

        $adakahAksesStatus = HakAksesJabatanStatus::where('hak_akses_jabatan_id', $adakahPermission->id)
            ->where('ms_status_id', $statusId)->get();
        if (!$adakahAksesStatus) {
            return false;
        }

        if ($adakahPermission && $adakahAksesCabang && $adakahAksesStatus)
            $diizinkankahsemua = true;
        else {
            $diizinkankahsemua = false;
        }
        return $diizinkankahsemua;
    }

    public function edit(MsPegawaiAkun $msPegawaiAkun, $halamanId, $cabangId, $statusId): bool
    {
        return HakAksesJabatan::where('ms_jabatan_id', \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->msJabatan->id)
            ->where('hak_akses_id', $halamanId)->exists();
    }

    public function update(MsPegawaiAkun $msPegawaiAkun, $halamanId, $cabangId, $statusId): bool
    {
        $adakahPermission = HakAksesJabatan::where('ms_jabatan_id', \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->msJabatan->id)
            ->where('hak_akses_id', $halamanId)->first();

        if (!$adakahPermission) {
            return false;
        }

        $adakahAksesCabang = HakAksesPegawaiCabang::where('ms_pegawai_id', \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->id)
            ->where('ms_cabang_id', $cabangId)->first();
        if (!$adakahAksesCabang) {
            return false;
        }

        $adakahAksesStatus = HakAksesJabatanStatus::where('hak_akses_jabatan_id', $adakahPermission->id)
            ->where('ms_status_id', $statusId)->get();
        if (!$adakahAksesStatus) {
            return false;
        }

        if ($adakahPermission && $adakahAksesCabang && $adakahAksesStatus)
            $diizinkankahsemua = true;
        else {
            $diizinkankahsemua = false;
        }
        return $diizinkankahsemua;
    }


    public function lihat(MsPegawaiAkun $msPegawaiAkun, $halamanId, $cabangId): bool
    {
        $adakahPermission = HakAksesJabatan::where('ms_jabatan_id', \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->msJabatan->id)
            ->where('hak_akses_id', $halamanId)->first();

        if (!$adakahPermission) {
            return false;
        }

        if ($adakahPermission)
            $diizinkankahsemua = true;
        else {
            $diizinkankahsemua = false;
        }
        return $diizinkankahsemua;
    }
}
