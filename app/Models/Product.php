<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use \Illuminate\Database\Eloquent\Factories\HasFactory;
  use \Illuminate\Database\Eloquent\Concerns\HasUuids;
  use \App\Helpers\BootModel\Traits\WithMasterBootModel;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'id',
    'product_category_first_id',
    'name',
    'selling_price',
    'availability',
    'image_url',
    'created_by',
    'updated_by',
    'created_at',
    'updated_at',
    'is_activated',
  ];

  public function productContent()
  {
    return $this->hasMany(ProductContent::class);
  }
}
