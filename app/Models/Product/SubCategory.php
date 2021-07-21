<?php

namespace App\Models\Product;

use App\Transformers\Product\SubCategoryTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
  use HasFactory, SoftDeletes;

  public $transformer = SubCategoryTransformer::class;

  protected $dates = [
    "deleted_at"
  ];

  protected $fillable = [
    'name'
  ];

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
