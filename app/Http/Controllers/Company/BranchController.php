<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\ApiController;
use App\Models\Company\Branch;
// use Illuminate\Http\Request;

class BranchController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $branches = Branch::all();
    return $this->showAll($branches);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Company\Branch  $branch
   * @return \Illuminate\Http\Response
   */
  public function show(Branch $branch)
  {
    return $this->showOne($branch);
  }
}
