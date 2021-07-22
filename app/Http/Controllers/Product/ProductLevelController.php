<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product\ProductLevel;
use Illuminate\Http\Request;

class ProductLevelController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $productLevels = ProductLevel::all();
    return $this->showAll($productLevels);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product\ProductLevel  $productLevel
   * @return \Illuminate\Http\Response
   */
  public function show(ProductLevel $product_level)
  {
    return $this->showOne($product_level);
  }
}
