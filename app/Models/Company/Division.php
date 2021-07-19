<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
  use HasFactory, SoftDeletes;

  protected $dates = [
    "deleted_at"
  ];

  protected $fillable = [
    'name'
  ];

  public function branches()
  {
    return $this->hasMany(Branch::class);
  }
}
