<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SalesOrder extends Model
{
    use HasFactory,HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
