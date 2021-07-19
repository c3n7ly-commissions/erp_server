<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccessGroup extends Model
{
  use HasFactory, SoftDeletes;

  protected $dates = [
    "deleted_at"
  ];

  protected $fillable = [
    "access_group_id",
    "user_id"
  ];
}
