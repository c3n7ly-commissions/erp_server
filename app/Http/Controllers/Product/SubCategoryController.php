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
    $rules = [
      "name" => "required|string"
    ];

    $request->validate($rules);
    $subcategory = SubCategory::create($request->all());

    return $this->showOne($subcategory);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product\SubCategory  $subcategory
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
   * @param  \App\Models\Product\SubCategory  $subcategory
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, SubCategory $subcategory)
  {
    $rules = [
      "name" => "required|string"
    ];
    $request->validate($rules);
    $subcategory->name = $request->name;

    if ($subcategory->isClean()) {
      return $this->errorResponse('you need to specify different values to update', 422);
    }

    $subcategory->save();

    return $this->showOne($subcategory, 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product\SubCategory  $subcategory
   * @return \Illuminate\Http\Response
   */
  public function destroy(SubCategory $subcategory)
  {
    $subcategory->delete();
    return $this->showOne($subcategory);
  }
}
