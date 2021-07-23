<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\ApiController;
use App\Models\Company\Branch;
use App\Models\Product\ProductLevel;
use Illuminate\Http\Request;

class BranchProductLevelController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Branch $branch)
  {
    $productLevels = $branch->productLevels;
    return $this->showAll($productLevels);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Branch $branch)
  {
    $rules = [
      "minimum_level" => "required|numeric",
      "maximum_level" => "required|numeric",
      "reorder_level" => "required|numeric",
      "quantity" => "required|numeric",
      "product_id" => "required|numeric|integer|exists:products,id",
    ];

    $request->validate($rules);
    $data = $request->all();

    $data['branch_id'] = $branch->id;
    $productLevel = ProductLevel::create($data);

    return $this->showOne($productLevel);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Company\Branch  $branch
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Branch $branch, ProductLevel $productLevel)
  {
    $rules = [
      "minimum_level" => "numeric",
      "maximum_level" => "numeric",
      "reorder_level" => "numeric",
      "quantity" => "numeric",
      "product_id" => "numeric|integer|exists:products,id",
    ];

    $request->validate($rules);
    $this->checkRelationship($branch, $productLevel);

    $productLevel->fill($request->only([
      "minimum_level",
      "maximum_level",
      "reorder_level",
      "quantity",
      "product_id",
    ]));

    if ($productLevel->isClean()) {
      return $this->errorResponse('you need to specify different values to update', 422);
    }

    $productLevel->save();

    return $this->showOne($productLevel);
  }

  public function checkRelationship(Branch $branch, ProductLevel $productLevel)
  {
    if ($branch->id != $productLevel->branch_id) {
      return  $this->showRelationshipError("branch", "productLevel");
    }
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Company\Branch  $branch
   * @return \Illuminate\Http\Response
   */
  public function destroy(Branch $branch, ProductLevel $productLevel)
  {
    $this->checkRelationship($branch, $productLevel);

    $productLevel->delete();

    return $this->showOne($productLevel);
  }
}
