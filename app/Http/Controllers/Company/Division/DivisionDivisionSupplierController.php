<?php

namespace App\Http\Controllers\Company\Division;

use App\Http\Controllers\ApiController;
use App\Models\Company\Division;
use App\Models\Company\Partners\Supplier\DivisionSupplier;
use App\Models\Partners\Supplier\Supplier;
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
  public function store(Request $request, Division $division)
  {
    $rules = [
      "supplier_id" => "required|numeric|integer|exists:suppliers,id",
    ];

    $request->validate($rules);
    $data = $request->all();
    $data["division_id"] =  $division->id;

    $supplier = Supplier::findOrFail($data['supplier_id']);
    if (!$supplier->isActive()) {
      return  $this->errorResponse("The selected supplier has not been activated", 422);
    }

    $divisionSupplier =  DivisionSupplier::create($data);
    return $this->showOne($divisionSupplier);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Company\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Division $division, DivisionSupplier $division_supplier)
  {
    $rules = [
      "supplier_id" => "numeric|integer|exists:suppliers,id",
    ];
    $request->validate($rules);
    $this->checkRelationship($division, $division_supplier);

    if ($request->has("supplier_id")) {
      $supplier = Supplier::findOrFail($request->supplier_id);
      if (!$supplier->isActive()) {
        return  $this->errorResponse("The selected supplier has not been activated", 422);
      } else {
        $division_supplier->supplier_id = $request->supplier_id;
      }
    }

    if ($division_supplier->isClean()) {
      return $this->errorResponse('you need to specify different values to update', 422);
    }

    $division_supplier->save();

    return $this->showOne($division_supplier);
  }

  public function checkRelationship(Division $division, DivisionSupplier $divisionSupplier)
  {
    if ($division->id != $divisionSupplier->division_id) {
      return  $this->showRelationshipError("division", "divisionSupplier");
    }
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Company\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function destroy(Division $division, DivisionSupplier $division_supplier)
  {
    $this->checkRelationship($division, $division_supplier);
    $division_supplier->delete();
    return $this->showOne($division_supplier);
  }
}
