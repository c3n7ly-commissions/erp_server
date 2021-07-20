<?php

namespace Database\Seeders;

use App\Models\Company\Branch;
use App\Models\Company\Division;
use App\Models\Product\Category;
use App\Models\Product\Product;
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
    DB::statement("SET FOREIGN_KEY_CHECKS = 0");

    User::truncate();
    Division::truncate();
    Branch::truncate();
    Category::truncate();
    SubCategory::truncate();
    Tax::truncate();
    Unit::truncate();
    Product::truncate();

    $userQt = 50;
    $divisionQt = 10;
    $branchQt = 100;
    $categoryQt = 50;
    $subCategoryQt = 100;
    $taxQt = 100;
    $unitQt = 50;
    $productQt = 300;

    User::factory($userQt)->create();
    Division::factory($divisionQt)->create();
    Branch::factory($branchQt)->create();
    Category::factory($categoryQt)->create();
    SubCategory::factory($subCategoryQt)->create();
    Tax::factory($taxQt)->create();
    Unit::factory($unitQt)->create();
    Product::factory($productQt)->create();
  }
}
