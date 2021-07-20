<?php

namespace App\Models\Company;

use App\Transformers\Company\BranchTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
  use HasFactory, SoftDeletes;

  public $transformer = BranchTransformer::class;

  protected $dates = [
    'deleted_at'
  ];

  protected $fillable = [
    "name",
    "email",
    "telephone",
    "postal_address",
    "physical_address",
    "division_id"
  ];

  public function division()
  {
    return  $this->belongsTo(Division::class);
  }
}
