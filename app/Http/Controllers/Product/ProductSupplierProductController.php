<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Partners\Supplier\SupplierProduct;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductSupplierProductController extends ApiController
{
  /**
   * Display a listing of the resource.
   * @param  \App\Models\Product\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function index(Product $product)
  {
    $supplierProducts = $product->supplierProducts;
    return $this->showAll($supplierProducts);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Product $product)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product\Product  $product
   * @param  \App\Models\Partners\Supplier\SupplierProduct  $supplier_product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product, SupplierProduct $supplier_product)
  {
    //
  }

  public function checkRelationship(Product $product, SupplierProduct $supplier_product)
  {
    if ($product->id != $supplier_product->product_id) {
      return  $this->showRelationshipError("product", "supplier_product");
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product\Product  $product
   * @param  \App\Models\Partners\Supplier\SupplierProduct  $supplier_product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product, SupplierProduct $supplier_product)
  {
    $this->checkRelationship($product, $supplier_product);
    $supplier_product->delete();
    return $this->showOne($supplier_product);
  }
}
