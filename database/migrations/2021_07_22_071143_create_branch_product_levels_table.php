<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchProductLevelsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('branch_product_levels', function (Blueprint $table) {
      $table->id();
      $table->unsignedDecimal("minimum_level", 12, 2);
      $table->unsignedDecimal("maximum_level", 12, 2);
      $table->unsignedDecimal("reorder_level", 12, 2);
      $table->unsignedDecimal("quantity", 12, 2);
      $table->unsignedBigInteger("branch_id");
      $table->unsignedBigInteger("product_id");
      $table->timestamps();
      $table->softDeletes();

      $table->unique(["branch_id", "product_id"]);

      $table->foreign('branch_id')->references('id')->on('branches');
      $table->foreign('product_id')->references('id')->on('products');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('branch_product_levels');
  }
}
