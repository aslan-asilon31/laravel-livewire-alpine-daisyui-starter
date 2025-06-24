<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Uuid;

class RoomStatus extends Model
{
    use HasUuids;

    protected $table = 'room_statuses';
    protected $primaryKey = 'flight_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function newUniqueId(): string

    {

        return (string) Uuid::uuid4();
    }
}
