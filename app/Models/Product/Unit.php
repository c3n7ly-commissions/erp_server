<?php

namespace App\Models\Product;

use App\Transformers\Product\UnitTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
  use HasFactory, SoftDeletes;

  public $transformer = UnitTransformer::class;

  protected $dates = [
    "deleted_at"
  ];

  protected $fillable = [
    'name',
    'description'
  ];


  public function productsBulk()
  {
    return $this->hasMany(Product::class, "bulk_unit_id");
  }

  public function productsAtomic()
  {
    return $this->hasMany(Product::class, "atomic_unit_id");
  }
}
