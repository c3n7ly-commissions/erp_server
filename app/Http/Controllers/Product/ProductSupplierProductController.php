<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Partners\Supplier\Supplier;
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
    $rules = [
      "supplier_id" => "required|numeric|integer|exists:suppliers,id",
    ];

    $request->validate($rules);
    $data = $request->all();

    if (!$product->isActive()) {
      return  $this->errorResponse("The selected product has not been activated", 422);
    }
    $data["product_id"] =  $product->id;


    $supplier = Supplier::findOrFail($data['supplier_id']);
    if (!$supplier->isActive()) {
      return  $this->errorResponse("The selected supplier has not been activated", 422);
    }

    $supplierProduct = SupplierProduct::create($data);
    return $this->showOne($supplierProduct);
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
    $rules = [
      "supplier_id" => "numeric|integer|exists:suppliers,id",
    ];

    $request->validate($rules);
    $this->checkRelationship($product, $supplier_product);


    if ($request->has("supplier_id")) {
      $supplier = Supplier::findOrFail($request->supplier_id);
      if (!$supplier->isActive()) {
        return  $this->errorResponse("The selected supplier has not been activated", 422);
      } else {
        $supplier_product->supplier_id = $request->supplier_id;
      }
    }

    if ($supplier_product->isClean()) {
      return $this->showUnchangedError();
    }

    $supplier_product->save();

    return $this->showOne($supplier_product);
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
