<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SalesOrderDetail extends Pivot
{
  use HasFactory,HasUuids;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $guarded = [];

  public function product()
  {
      return $this->belongsTo(Product::class);
  }
}
