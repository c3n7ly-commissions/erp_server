<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\ApiController;
use App\Models\Company\Division;
use Illuminate\Http\Request;

class DivisionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::all();
        return $this->showAll($divisions);
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
        $division = Division::create($request->all());

        return $this->showOne($division, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        return $this->showOne($division);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        $rules = [
            "name" => "required|string"
        ];
        $request->validate($rules);
        $division->name = $request->name;

        if ($division->isClean()) {
            return $this->errorResponse(['error' => 'you need to specify different values to update'], 422);
        }


        return $this->showOne($division, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        $division->delete();
        return $this->showOne($division);
    }
}
