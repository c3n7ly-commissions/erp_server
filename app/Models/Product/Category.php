<?php

namespace App\Models\Product;

use App\Transformers\Product\CategoryTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use HasFactory, SoftDeletes;

  public $transformer = CategoryTransformer::class;

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
