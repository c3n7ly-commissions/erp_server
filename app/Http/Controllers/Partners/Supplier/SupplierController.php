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
    $rules = [
      "name" => "required|string",
      "email" => "required|string|email",
      "telephone" => "required|string",
      "postal_address" => "required|string",
      "physical_address" => "required|string",
      "tax_id" => "required|string",
      "payment_terms" => "required|numeric",
      "credit_limit" => "required|numeric",
    ];

    $request->validate($rules);
    $data = $request->all();
    $data['status'] = Supplier::INACTIVE;
    $supplier = Supplier::create($data);

    return $this->showOne($supplier);
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
    $rules = [
      "name" => "string",
      "email" => "string|email",
      "telephone" => "string",
      "postal_address" => "string",
      "physical_address" => "string",
      "tax_id" => "string",
      "status" => "in:" . Supplier::ACTIVE . "," . Supplier::INACTIVE . "," . Supplier::PENDING . "," . Supplier::REJECTED,
      "status_reason" => "string",
      "payment_terms" => "numeric",
      "credit_limit" => "numeric",
    ];

    $request->validate($rules);

    if ($request->filled('status') && $request->status == Supplier::REJECTED) {
      if ($supplier->status != Supplier::PENDING) {
        return $this->showRejectingNotAllowed("suppliers", Supplier::PENDING);
      }

      if (!$request->filled('status_reason')) {
        return $this->showStatusReasonRequired(Supplier::REJECTED);
      } else {
        $supplier->status_reason = $request->status_reason;
      }
    }

    $supplier->fill($request->only([
      "name",
      "email",
      "telephone",
      "postal_address",
      "physical_address",
      "tax_id",
      "status",
      "payment_terms",
      "credit_limit",
    ]));

    if ($supplier->status != Supplier::REJECTED) {
      $supplier->status_reason = "";
    }

    if ($supplier->isClean()) {
      return $this->showUnchangedError();
    }

    $supplier->save();

    return $this->showOne($supplier);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Partners\Supplier\Supplier  $supplier
   * @return \Illuminate\Http\Response
   */
  public function destroy(Supplier $supplier)
  {
    $supplier->delete();

    return $this->showOne($supplier);
  }
}
