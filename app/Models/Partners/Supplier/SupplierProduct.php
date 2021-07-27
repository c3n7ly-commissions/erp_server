<?php

namespace App\Models\Partners\Supplier;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierProduct extends Model
{
  use HasFactory, SoftDeletes;

  protected $dates = [
    'deleted_at'
  ];

  protected $fillable = [
    "supplier_id",
    "product_id",
  ];

  public function supplier()
  {
    return $this->belongsTo(Supplier::class);
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
