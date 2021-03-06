<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessPageGroupsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('access_page_groups', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('access_group_id');
      $table->unsignedBigInteger('page_group_id');
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('access_group_id')->references('id')->on('access_groups');
      $table->foreign('page_group_id')->references('id')->on('page_groups');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('access_page_groups');
  }
}
