<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $categories = Category::all();
    return $this->showAll($categories);
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
    $category = Category::create($request->all());

    return $this->showOne($category);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function show(Category $category)
  {
    return $this->showOne($category);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Category $category)
  {
    //
    $rules = [
      "name" => "required|string"
    ];
    $request->validate($rules);
    $category->name = $request->name;

    if ($category->isClean()) {
      return $this->errorResponse('you need to specify different values to update', 422);
    }

    $category->save();

    return $this->showOne($category, 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function destroy(Category $category)
  {
    $category->delete();
    return $this->showOne($category);
  }
}
