<?php

use App\Models\Product\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('code');
      $table->unsignedDecimal('bulk_weight', 12, 2);
      $table->unsignedDecimal('conversion', 12, 2);
      $table->unsignedDecimal('bulk_selling_price', 12, 2);
      $table->unsignedDecimal('atomic_selling_price', 12, 2);
      $table->unsignedDecimal('exp_amount_before_tax', 12, 2);
      $table->unsignedDecimal('exp_purchase_price', 12, 2);
      $table->unsignedDecimal('exp_profit_margin', 5, 2);
      $table->string('status')->default(Product::PENDING);
      $table->text('status_reason')->nullable();
      $table->unsignedBigInteger('division_id');
      $table->unsignedBigInteger('tax_id');
      $table->unsignedBigInteger('category_id');
      $table->unsignedBigInteger('sub_category_id');
      $table->unsignedBigInteger('bulk_unit_id');
      $table->unsignedBigInteger('atomic_unit_id');
      $table->string('image');
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('division_id')->references('id')->on('divisions');
      $table->foreign('tax_id')->references('id')->on('taxes');
      $table->foreign('category_id')->references('id')->on('categories');
      $table->foreign('sub_category_id')->references('id')->on('sub_categories');
      $table->foreign('bulk_unit_id')->references('id')->on('units');
      $table->foreign('atomic_unit_id')->references('id')->on('units');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('products');
  }
}
