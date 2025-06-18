<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Helpers\Permission\Traits\HasAccess;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HakAksesJabatanStatus  extends  Authenticatable
{
    use HasFactory, HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    public $table = 'hak_akses_jabatan_status';
    public $timestamps = false;
    public $guarded = [];

    const CREATED_AT = 'tgl_dibuat';
    const UPDATED_AT = 'tgl_diupdate';

    public function hakAksesJabatan()
    {
        return $this->belongsTo(HakAksesJabatan::class, 'hak_akses_jabatan_id', 'id');
    }

    public function msStatus()
    {
        return $this->belongsTo(MsStatus::class, 'ms_status_id', 'id');
    }
}
