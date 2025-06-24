<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Uuid;

class BedType extends Model
{
    use HasUuids;

    protected $table = 'bed_types';
    protected $primaryKey = 'flight_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function newUniqueId(): string

    {

        return (string) Uuid::uuid4();
    }
}
