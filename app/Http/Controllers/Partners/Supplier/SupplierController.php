<?php

namespace App\Http\Controllers\Partners\Supplier;

use App\Http\Controllers\ApiController;
use App\Models\Partners\Supplier\Supplier;
use Illuminate\Http\Request;

class SupplierController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $suppliers = Supplier::all();
    return $this->showAll($suppliers);
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
   * @param  \App\Models\Partners\Supplier\Supplier  $supplier
   * @return \Illuminate\Http\Response
   */
  public function show(Supplier $supplier)
  {
    return $this->showOne($supplier);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Partners\Supplier\Supplier  $supplier
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Supplier $supplier)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Partners\Supplier\Supplier  $supplier
   * @return \Illuminate\Http\Response
   */
  public function destroy(Supplier $supplier)
  {
    //
  }
}
