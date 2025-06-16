<?php

namespace App\Policies;

use App\Models\MsPegawai;
use App\Models\HakAkses;
use Spatie\Permission\Models\Permission;
use App\Models\PegawaiAksesCabang;
use App\Models\RoleAksesStatus;
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

    public function daftar(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {
        return true;
    }

    public function buat(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {
        return true;
    }

    public function simpan(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {
        return true;
    }

    public function edit(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {
        return true;
    }

    public function update(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {
        dd('stop');
        $semuaPermission = HakAkses::where()::pluck('name')
            ->contains($halaman);
        $adakahPermission = $msPegawai->getAllPermissions()
            ->pluck('name')
            ->contains($halaman);
        if (!$adakahPermission) {
            return false;
        }

        $adakahAksesCabang = PegawaiAksesCabang::where('ms_pegawai_id', $msPegawai->id)->value('ms_cabang_id');
        if ($adakahAksesCabang != $cabang) {
            return false;
        }

        $halamanId = Permission::where('name', $halaman)->value('id');
        $adakahAksesStatus = RoleAksesStatus::where('role_id', $msPegawai->roles()->pluck('id')->toArray())
            ->where('permission_id', $halamanId)
            ->where('status', 'aktif')
            ->exists();
        if ($adakahAksesStatus != $status) {
            return false;
        }

        if ($adakahPermission && $adakahAksesCabang && $adakahAksesStatus)
            $diizinkankahsemua = true;
        else {
            $diizinkankahsemua = false;
        }
        return $diizinkankahsemua;
    }

    public function hapus(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {
        return true;
    }

    public function lihat(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {
        return true;
    }
}
