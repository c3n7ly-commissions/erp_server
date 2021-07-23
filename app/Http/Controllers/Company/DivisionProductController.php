<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\ApiController;
use App\Models\Company\Division;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DivisionProductController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Division $division)
  {
    $products = $division->products;

    return $this->showAll($products);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Company\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Division $division)
  {
    $rules = [
      "name" => "required|string",
      "code" => "required|string",
      "bulk_weight" => "required|numeric",
      "conversion" => "required|numeric",
      "bulk_selling_price" => "required|numeric",
      "atomic_selling_price" => "required|numeric",
      "exp_amount_before_tax" => "required|numeric",
      "exp_purchase_price" => "required|numeric",
      "exp_profit_margin" => "required|numeric",
      "tax_id" => "required|numeric|integer|exists:taxes,id",
      "category_id" => "required|numeric|integer|exists:categories,id",
      "sub_category_id" => "required|numeric|integer|exists:sub_categories,id",
      "bulk_unit_id" => "required|numeric|integer|exists:units,id",
      "atomic_unit_id" => "required|numeric|integer|exists:units,id",
      "image" => "required|image",
    ];

    $request->validate($rules);

    $data = $request->all();
    $data['status'] = Product::INACTIVE;
    $data['image'] = $request->image->store('', 'images');
    $data['division_id'] = $division->id;

    $product = Product::create($data);

    return $this->showOne($product);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Company\Division  $division
   * @param  \App\Models\Product\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Division $division, Product $product)
  {
    $rules = [
      "name" => "string",
      "code" => "string",
      "bulk_weight" => "numeric",
      "conversion" => "numeric",
      "bulk_selling_price" => "numeric",
      "atomic_selling_price" => "numeric",
      "exp_amount_before_tax" => "numeric",
      "exp_purchase_price" => "numeric",
      "exp_profit_margin" => "numeric",
      "status" => "in:" . Product::ACTIVE . "," . Product::INACTIVE . "," . Product::REJECTED,
      "status_reason" => "string",
      "tax_id" => "numeric|integer|exists:taxes,id",
      "category_id" => "numeric|integer|exists:categories,id",
      "sub_category_id" => "numeric|integer|exists:sub_categories,id",
      "bulk_unit_id" => "numeric|integer|exists:units,id",
      "atomic_unit_id" => "numeric|integer|exists:units,id",
      "image" => "image",
    ];
    $request->validate($rules);

    $this->checkRelationship($division, $product);

    $product->fill($request->only([
      "name",
      "code",
      "bulk_weight",
      "conversion",
      "bulk_selling_price",
      "atomic_selling_price",
      "exp_amount_before_tax",
      "exp_purchase_price",
      "exp_profit_margin",
      "status",
      "status_reason",
      "tax_id",
      "category_id",
      "sub_category_id",
      "bulk_unit_id",
      "atomic_unit_id",
    ]));

    if ($request->filled('status') && $request->status == Product::REJECTED) {
      if (!$request->filled('status_reason')) {
        return $this->showStatusReasonRequired(Product::REJECTED);
      } else {
        $product->status_reason = $request->status_reason;
      }
    }

    if ($product->status != Product::REJECTED) {
      $product->status_reason = "";
    }

    if ($request->hasFile('image')) {
      Storage::disk("images")->delete($product->image);
      $product->image = $request->image->store('', 'images');
    }

    if ($product->isClean()) {
      return $this->showUnchangedError();
    }

    $product->save();

    return $this->showOne($product);
  }

  public function checkRelationship(Division $division, Product $product)
  {
    if ($division->id != $product->division_id) {
      throw new HttpException(
        422,
        "there exists no relationship between the passed division and product"
      );
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Company\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function destroy(Division $division, Product $product)
  {
    $this->checkRelationship($division, $product);

    $product->delete();

    return $this->showOne($product);
  }
}
