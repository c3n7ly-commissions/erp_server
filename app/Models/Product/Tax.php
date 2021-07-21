<?php

namespace App\Models\Product;

use App\Transformers\Product\TaxTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
  use HasFactory, SoftDeletes;

  public $transformer = TaxTransformer::class;

  protected $dates = [
    "deleted_at"
  ];

  protected $fillable = [
    'name',
    'value'
  ];


  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
