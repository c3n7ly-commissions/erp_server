<?php

namespace App\Http\Controllers\Partners\Supplier;

use App\Http\Controllers\ApiController;
use App\Models\Partners\Supplier\SupplierProduct;
use Illuminate\Http\Request;

class SupplierProductController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $suplierProducts = SupplierProduct::all();
    return $this->showAll($suplierProducts);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Partners\Supplier\SupplierProduct  $supplier_product
   * @return \Illuminate\Http\Response
   */
  public function show(SupplierProduct $supplier_product)
  {
    return $this->showOne($supplier_product);
  }
}
