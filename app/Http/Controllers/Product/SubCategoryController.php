<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $subcategories = SubCategory::all();
    return $this->showAll($subcategories);
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
   * @param  \App\Models\Product\SubCategory  $subCategory
   * @return \Illuminate\Http\Response
   */
  public function show(SubCategory $subcategory)
  {
    return $this->showOne($subcategory);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product\SubCategory  $subCategory
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, SubCategory $subCategory)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product\SubCategory  $subCategory
   * @return \Illuminate\Http\Response
   */
  public function destroy(SubCategory $subcategory)
  {
    $subcategory->delete();
    return $this->showOne($subcategory);
  }
}
