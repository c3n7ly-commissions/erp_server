<?php

namespace App\Models\Company\Partners\Supplier;

use App\Models\Company\Division;
use App\Models\Partners\Supplier\Supplier;
use App\Transformers\Company\Partners\Supplier\DivisionSupplierTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DivisionSupplier extends Model
{
  use HasFactory, SoftDeletes;

  public $transformer = DivisionSupplierTransformer::class;

  protected $dates = [
    "deleted_at"
  ];

  protected $fillable = [
    "division_id",
    "supplier_id",
  ];

  public function division()
  {
    return $this->belongsTo(Division::class);
  }

  public function supplier()
  {
    return $this->belongsTo(Supplier::class);
  }
}
