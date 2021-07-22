<?php

namespace App\Models\Product;

use App\Transformers\Product\ProductLevelTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLevel extends Model
{
  use HasFactory, SoftDeletes;

  public $transformer = ProductLevelTransformer::class;

  protected $dates = [
    "deleted_at"
  ];

  protected $fillable =  [
    "minimum_level",
    "maximum_level",
    "reorder_level",
    "quantity",
    "branch_id",
    "product_id",
  ];

  public function branch()
  {
    return $this->belongsTo(Branch::class);
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function sellable()
  {
    return $this->quantity > $this->minimum_level;
  }

  public function understocked()
  {
    return $this->quantity <= $this->reorder_level;
  }
}
