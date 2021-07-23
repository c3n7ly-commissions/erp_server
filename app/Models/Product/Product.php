<?php

namespace App\Models\Product;

use App\Models\Company\Division;
use App\Transformers\Product\ProductTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use HasFactory, SoftDeletes;

  public $transformer = ProductTransformer::class;

  const ACTIVE = "active";
  const INACTIVE = "inactive";
  const REJECTED = "rejected";

  protected $dates = [
    'deleted_at'
  ];

  protected $fillable = [
    "name",
    "code",
    "bulk_weight",
    "conversion",
    "bulk_selling_price",
    "atomic_selling_price",
    "exp_amount_before_tax",
    "exp_purchase_price",
    "exp_profit_margin",
    "status",
    "status_reason",
    "division_id",
    "tax_id",
    "category_id",
    "sub_category_id",
    "bulk_unit_id",
    "atomic_unit_id",
    "image"
  ];

  public function division()
  {
    return $this->belongsTo(Division::class);
  }

  public function tax()
  {
    return $this->belongsTo(Tax::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function subCategory()
  {
    return $this->belongsTo(SubCategory::class);
  }

  public function bulkUnit()
  {
    return $this->belongsTo(Unit::class, "bulk_unit_id");
  }

  public function atomicUnit()
  {
    return $this->belongsTo(Unit::class, "atomic_unit_id");
  }

  public function productLevels()
  {
    return $this->hasMany(ProductLevel::class);
  }

  public function isActive()
  {
    return $this->status == Product::ACTIVE;
  }
}
