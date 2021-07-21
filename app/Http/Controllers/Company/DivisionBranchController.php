<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\ApiController;
use App\Models\Company\Branch;
use App\Models\Company\Division;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DivisionBranchController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Division $division)
  {
    $branches = $division->branches;
    return $this->showAll($branches);
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Division $division)
  {
    $rules = [
      "name" => "required|string",
      "email" => "required|string|email",
      "telephone" => "required|string",
      "postal_address" => "required|string",
      "physical_address" => "required|string",
    ];

    $request->validate($rules);
    $data = $request->all();

    $data['division_id'] = $division->id;
    $branch = Branch::create($data);

    return $this->showOne($branch);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Company\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Division $division, Branch $branch)
  {
    $rules = [
      "name" => "string",
      "email" => "string|email",
      "telephone" => "string",
      "postal_address" => "string",
      "physical_address" => "string",
    ];

    $request->validate($rules);
    $this->checkRelationship($division, $branch);

    $branch->fill($request->only([
      "name",
      "email",
      "telephone",
      "postal_address",
      "physical_address",
    ]));


    if ($branch->isClean()) {
      return $this->errorResponse('you need to specify different values to update', 422);
    }

    $branch->save();

    return $this->showOne($branch);
  }

  public function checkRelationship(Division $division, Branch $branch)
  {
    if ($division->id != $branch->division_id) {
      throw new HttpException(
        422,
        "there exists no relationship between the passed division and branch"
      );
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Company\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function destroy(Division $division, Branch $branch)
  {
    $this->checkRelationship($division, $branch);

    $branch->delete();

    return $this->showOne($branch);
  }
}
