<?php

namespace App\Models\Partners\Supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
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
}
