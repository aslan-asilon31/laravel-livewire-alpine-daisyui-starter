<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Helpers\Permission\Traits\HasAccess;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MsPegawai  extends  Authenticatable
{
    use HasFactory, HasUuids;
    protected $guard_name = 'pegawai';
    protected $keyType = 'string';
    public $incrementing = false;
    public $table = 'ms_pegawai';
    public $timestamps = false;
    public $guarded = [];

    const CREATED_AT = 'tgl_dibuat';
    const UPDATED_AT = 'tgl_diupdate';


    public function msPegawaiAkun()
    {
        return $this->hasMany(MsPegawaiAkun::class, 'id', 'ms_pegawai_id');
    }

    public function hakAksesPegawaiCabang()
    {
        return $this->hasMany(HakAksesPegawaiCabang::class, 'ms_pegawai_id', 'id');
    }

    public function msJabatan()
    {
        return $this->belongsTo(MsJabatan::class, 'ms_jabatan_id', 'id');
    }


    public function hakAksesJabatans()
    {
        return $this->hasMany(HakAksesJabatan::class, 'ms_pegawai_id');
    }


    public function hakAkses()
    {
        return $this->hasManyThrough(HakAkses::class, HakAksesJabatan::class, 'ms_pegawai_id', 'id', 'id', 'hak_akses_id');
    }

    // public function modelHasRoles()
    // {
    //     return $this->hasMany(ModelHasRole::class, 'model_id');
    // }

    // public function msPegawaiAkun()
    // {
    //     return $this->belongsTo(MsPegawaiAkun::class);
    // }

    // public function hakAksesPegeawaiCabang()
    // {
    //     return $this->belongsTo(HakAksesPegawaiCabang::class);
    // }
}
