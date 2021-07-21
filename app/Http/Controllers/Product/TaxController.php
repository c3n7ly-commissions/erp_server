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
    $rules = [
      "name" => "required|string",
      "value" => "required|numeric"
    ];

    $request->validate($rules);
    $tax = Tax::create($request->all());

    return $this->showOne($tax);
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
    $rules = [
      "name" => "string",
      "value" => "numeric"
    ];

    $request->validate($rules);
    $tax->fill($request->only([
      "name",
      "value"
    ]));

    if ($tax->isClean()) {
      return $this->errorResponse('you need to specify different values to update', 422);
    }

    $tax->save();

    return $this->showOne($tax);
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
