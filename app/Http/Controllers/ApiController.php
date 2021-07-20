<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;

class ApiController extends Controller
{
  public function __construct()
  {
  }

  use ApiResponse;
}
