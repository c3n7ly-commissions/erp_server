<?php

namespace App\Models\Company;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchProductLevel extends Model
{
  use HasFactory, SoftDeletes;

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
}
