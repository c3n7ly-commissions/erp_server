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
    $division_count = Division::all()->count();
    $supplier_count = Supplier::all()->count();
    $division_suppliers = [];
    for ($i = 1; $i <= $division_count; $i++) {
      for ($j = 1; $j <= $supplier_count; $j++) {
        array_push($division_suppliers, $i . "-" . $j);
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
