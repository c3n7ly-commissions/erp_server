<?php

namespace Database\Factories\Company\Partners\Supplier;

use App\Models\Company\Division;
use App\Models\Company\Partners\Supplier\DivisionSupplier;
use App\Models\Partners\Supplier\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionSupplierFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = DivisionSupplier::class;

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

    $division_count = Division::all()->count();

    $division_suppliers = [];
    for ($i = 1; $i <= $division_count; $i++) {
      foreach ($valid_suppliers as $valid_supplier) {
        array_push($division_suppliers, $i . "-" . $valid_supplier);
      }
    }

    $division_and_supplier = $this->faker->unique->randomElement($division_suppliers);
    $division_and_supplier = explode('-', $division_and_supplier);
    $division_id = $division_and_supplier[0];
    $supplier_id = $division_and_supplier[1];

    return [
      "division_id" =>  $division_id,
      "supplier_id" => $supplier_id
    ];
  }
}
