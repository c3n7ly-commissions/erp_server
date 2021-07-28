<?php

namespace App\Http\Controllers\Partners\Supplier;

use App\Http\Controllers\ApiController;
use App\Models\Partners\Supplier\Supplier;
use Illuminate\Http\Request;

class SupplierSupplierProductController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Partners\Supplier\Supplier  $supplier
   * @return \Illuminate\Http\Response
   */
  public function index(Supplier $supplier)
  {
    $supplierProducts = $supplier->supplierProducts;
    return $this->showAll($supplierProducts);
  }
}
