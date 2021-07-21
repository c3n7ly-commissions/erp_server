<?php

namespace App\Models\Company;

use App\Models\Product\Product;
use App\Transformers\Company\DivisionTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
  use HasFactory, SoftDeletes;

  public $transformer = DivisionTransformer::class;

  protected $dates = [
    "deleted_at"
  ];

  protected $fillable = [
    'name'
  ];

  public function branches()
  {
    return $this->hasMany(Branch::class);
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
