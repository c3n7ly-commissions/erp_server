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
    $producLevels = $branch->productLevels;
    return $this->showAll($producLevels);
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
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Company\Branch  $branch
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Branch $branch)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Company\Branch  $branch
   * @return \Illuminate\Http\Response
   */
  public function destroy(Branch $branch)
  {
    //
  }
}
