<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product\Unit;
use Illuminate\Http\Request;

class UnitController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $units = Unit::all();
    return $this->showAll($units);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product\Unit  $unit
   * @return \Illuminate\Http\Response
   */
  public function show(Unit $unit)
  {
    return $this->showOne($unit);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product\Unit  $unit
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Unit $unit)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product\Unit  $unit
   * @return \Illuminate\Http\Response
   */
  public function destroy(Unit $unit)
  {
    $unit->delete();

    return $this->showOne($unit);
  }
}
