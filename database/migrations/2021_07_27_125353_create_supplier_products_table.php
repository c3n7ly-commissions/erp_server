<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('supplier_products', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("supplier_id");
      $table->unsignedBigInteger("product_id");
      $table->timestamps();
      $table->softDeletes();

      $table->unique(["supplier_id", "product_id"]);

      $table->foreign('supplier_id')->references('id')->on('suppliers');
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
    Schema::dropIfExists('supplier_products');
  }
}
