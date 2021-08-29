<?php

namespace Database\Seeders;

use App\Models\Company\Branch;
use App\Models\Company\Division;
use App\Models\Company\Partners\Supplier\DivisionSupplier;
use App\Models\Partners\Supplier\Supplier;
use App\Models\Partners\Supplier\SupplierProduct;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductLevel;
use App\Models\Product\SubCategory;
use App\Models\Product\Tax;
use App\Models\Product\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // for MySQL
    // DB::statement("SET FOREIGN_KEY_CHECKS = 0");

    SupplierProduct::truncate();
    DivisionSupplier::truncate();
    Supplier::truncate();

    ProductLevel::truncate();
    Product::truncate();

    Tax::truncate();
    Unit::truncate();
    SubCategory::truncate();
    Category::truncate();

    Branch::truncate();
    Division::truncate();
    User::truncate();

    $userQt = 50;
    $divisionQt = 10;
    $branchQt = 100;
    $categoryQt = 50;
    $subCategoryQt = 100;
    $taxQt = 100;
    $unitQt = 50;
    $productQt = 500;
    $plQt = 300;
    $supplierQt = 1000;
    $divisionSuppliersQt = 300;
    $supplierProductQt = 300;


    // Log to console 
    // https://stackoverflow.com/a/45864432/7450617
    $this->command->info("Seeding:");

    $this->command->info("\t User");
    User::factory($userQt)->create();

    $this->command->info("\t Division");
    Division::factory($divisionQt)->create();

    $this->command->info("\t Branch");
    Branch::factory($branchQt)->create();

    $this->command->info("\t Category");
    Category::factory($categoryQt)->create();

    $this->command->info("\t SubCategory");
    SubCategory::factory($subCategoryQt)->create();

    $this->command->info("\t Tax");
    Tax::factory($taxQt)->create();

    $this->command->info("\t Unit");
    Unit::factory($unitQt)->create();

    $this->command->info("\t Product");
    Product::factory($productQt)->create();

    $this->command->info("\t ProductLevel");
    ProductLevel::factory($plQt)->create();

    $this->command->info("\t Supplier");
    Supplier::factory($supplierQt)->create();

    $this->command->info("\t DivisionSupplier");
    DivisionSupplier::factory($divisionSuppliersQt)->create();

    $this->command->info("\t SupplierProduct");
    SupplierProduct::factory($supplierProductQt)->create();
  }
}
