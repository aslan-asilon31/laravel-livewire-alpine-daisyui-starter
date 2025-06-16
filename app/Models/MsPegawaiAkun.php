<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Helpers\Permission\Traits\HasAccess;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MsPegawaiAkun extends  Authenticatable
{
    use HasFactory, HasUuids;
    protected $guard_name = 'pegawai';
    protected $keyType = 'string';
    public $incrementing = false;
    public $table = 'ms_pegawai_akun';
    public $timestamps = false;
    public $guarded = [];

    const CREATED_AT = 'tgl_dibuat';
    const UPDATED_AT = 'tgl_diupdate';

    public function msPegawai()
    {
        return $this->belongsTo(MsPegawai::class, 'ms_pegawai_id', 'id');
    }
}
