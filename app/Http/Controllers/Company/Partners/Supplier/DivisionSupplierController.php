<?php

namespace App\Http\Controllers\Company\Partners\Supplier;

use App\Http\Controllers\ApiController;
use App\Models\Company\Partners\Supplier\DivisionSupplier;
use Illuminate\Http\Request;

class DivisionSupplierController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $divisionSupplier = DivisionSupplier::all();
    return $this->showAll($divisionSupplier);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Company\Partners\Supplier\DivisionSupplier  $divisionSupplier
   * @return \Illuminate\Http\Response
   */
  public function show(DivisionSupplier $division_supplier)
  {
    return $this->showOne($division_supplier);
  }
}
