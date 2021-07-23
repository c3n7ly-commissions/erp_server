<?php

namespace App\Http\Controllers\Partners\Supplier;

use App\Http\Controllers\ApiController;
use App\Models\Partners\Supplier\Supplier;
use Illuminate\Http\Request;

class SupplierDivisionSupplierController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Supplier $supplier)
  {
    $divisionSupplier = $supplier->divisionSuppliers;
    return $this->showAll($divisionSupplier);
  }
}
