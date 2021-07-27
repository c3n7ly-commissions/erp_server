<?php

namespace Database\Factories\Partners\Supplier;

use App\Models\Partners\Supplier\Supplier;
use App\Models\Partners\Supplier\SupplierProduct;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierProductFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = SupplierProduct::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $valid_suppliers = Supplier::where("status", Supplier::ACTIVE)
      ->select("id")
      ->get()
      ->pluck("id")
      ->toArray();

    $valid_products = Product::where("status", Product::ACTIVE)
      ->select("id")
      ->get()
      ->pluck("id")
      ->toArray();

    $supplier_products = [];
    foreach ($valid_suppliers as $valid_supplier) {
      foreach ($valid_products as $valid_product) {
        array_push($division_suppliers, $valid_supplier . "-" . $valid_product);
      }
    }

    $supplier_and_product = $this->faker->unique->randomElement($supplier_products);
    $supplier_and_product = explode('-', $supplier_and_product);
    $supplier_id = $supplier_and_product[0];
    $product_id = $supplier_and_product[1];

    return [
      "supplier_id" => $supplier_id,
      "product_id" => $product_id
    ];
  }
}
