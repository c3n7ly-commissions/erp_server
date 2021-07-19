<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'email',
    'telephone',
    'postal_address',
    'physical_address',
    'logo'
  ];
}
