<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Helpers\Permission\Traits\HasAccess;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MsJabatan  extends  Authenticatable
{
    use HasFactory, HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    public $table = 'ms_jabatan';
    public $timestamps = false;
    public $guarded = [];

    const CREATED_AT = 'tgl_dibuat';
    const UPDATED_AT = 'tgl_diupdate';

    public function msPegawai()
    {
        return $this->hasMany(MsPegawai::class, 'ms_jabatan_id', 'id');
    }

    public function hakAksesJabatan()
    {
        return $this->belongsTo(HakAksesJabatan::class);
    }


    public function hakAkses()
    {
        return $this->belongsToMany(
            \App\Models\HakAkses::class,
            'hak_akses_jabatan',
            'ms_jabatan_id',
            'hak_akses_id'
        );
    }
}
