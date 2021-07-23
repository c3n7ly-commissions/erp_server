<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionSuppliersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('division_suppliers', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("division_id");
      $table->unsignedBigInteger("supplier_id");
      $table->timestamps();
      $table->softDeletes();

      $table->unique(["division_id", "supplier_id"]);

      $table->foreign('division_id')->references('id')->on('divisions');
      $table->foreign('supplier_id')->references('id')->on('suppliers');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('division_suppliers');
  }
}
