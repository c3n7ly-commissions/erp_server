<?php

namespace App\Http\Controllers\Company\Division;

use App\Http\Controllers\ApiController;
use App\Models\Company\Division;
use Illuminate\Http\Request;

class DivisionDivisionSupplierController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Division $division)
  {
    $divisionSuppliers = $division->divisionSuppliers;
    return $this->showAll($divisionSuppliers);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Company\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Division $division)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Company\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function destroy(Division $division)
  {
    //
  }
}
