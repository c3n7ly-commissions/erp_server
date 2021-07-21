<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product\Tax;
use Illuminate\Http\Request;

class TaxController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $taxes = Tax::all();
    return $this->showAll($taxes);
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
   * @param  \App\Models\Product\Tax  $tax
   * @return \Illuminate\Http\Response
   */
  public function show(Tax $tax)
  {
    return $this->showOne($tax);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product\Tax  $tax
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Tax $tax)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product\Tax  $tax
   * @return \Illuminate\Http\Response
   */
  public function destroy(Tax $tax)
  {
    $tax->delete($tax);
    return $this->showOne($tax);
  }
}
