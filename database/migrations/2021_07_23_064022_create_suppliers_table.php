<?php

use App\Models\Partners\Supplier\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('suppliers', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email');
      $table->string("telephone");
      $table->string("postal_address");
      $table->string("physical_address");
      $table->string("tax_id")->unique();
      $table->string("status")->default(Supplier::INACTIVE);
      $table->text("status_reason")->nullable();
      $table->unsignedDecimal("payment_terms", 12, 2);
      $table->unsignedDecimal("credit_limit", 12, 2);
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('suppliers');
  }
}
