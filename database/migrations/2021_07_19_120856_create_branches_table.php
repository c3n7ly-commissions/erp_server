<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('branches', function (Blueprint $table) {
      $table->id();
      $table->string("name");
      $table->string("email");
      $table->string("telephone");
      $table->string("postal_address");
      $table->string("physical_address");
      $table->unsignedBigInteger("division_id");
      $table->timestamps();
      $table->softDeletes();

      $table->foreign("division_id")->references("id")->on("divisions");
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('branches');
  }
}
