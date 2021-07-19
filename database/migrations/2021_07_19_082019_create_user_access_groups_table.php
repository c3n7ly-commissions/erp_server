<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccessGroupsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_access_groups', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('access_group_id');
      $table->unsignedBigInteger('user_id');
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('access_group_id')->references('id')->on('access_groups');
      $table->foreign('user_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_access_groups');
  }
}
