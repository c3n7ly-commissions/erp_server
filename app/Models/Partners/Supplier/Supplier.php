<?php

namespace App\Models\Partners\Supplier;

use App\Models\Company\Partners\Supplier\DivisionSupplier;
use App\Transformers\Partners\Supplier\SupplierTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
  use HasFactory, SoftDeletes;

  const ACTIVE = "active";
  const INACTIVE = "inactive";
  const PENDING = "pending";
  const REJECTED = "rejected";


  public $transformer = SupplierTransformer::class;

  protected $dates = [
    'deleted_at'
  ];

  protected $fillable = [
    "name",
    "email",
    "telephone",
    "postal_address",
    "physical_address",
    "tax_id",
    "status",
    "status_reason",
    "payment_terms",
    "credit_limit",
  ];

  public function divisionSuppliers()
  {
    return $this->hasMany(DivisionSupplier::class);
  }

  public function isActive()
  {
    return $this->status == Supplier::ACTIVE;
  }

  public function isInactive()
  {
    return $this->status == Supplier::INACTIVE;
  }

  public function isPending()
  {
    return $this->status == Supplier::PENDING;
  }

  public function isRejected()
  {
    return $this->status == Supplier::REJECTED;
  }
}
