<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use HasFactory, SoftDeletes;

  const ACTIVE = "active";
  const INACTIVE = "inactive";
  const REJECTED = "rejected";

  protected $dates = [
    'deleted_at'
  ];

  protected $fillable = [
    "name",
    "code",
    "weight",
    "bulk_selling_price",
    "conversion",
    "atomic_selling_price",
    "amount_before_tax",
    "purchase_price",
    "profit_margin",
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
}
