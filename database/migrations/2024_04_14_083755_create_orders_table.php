<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id');
      $table->string('shipping_phone_number');
      $table->string('shipping_city');
      $table->string('shipping_postal_code');
      $table->integer('product_id');
      $table->integer('quantity');
      $table->integer('total_price');
      $table->string('status')->default('pending');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('orders');
  }
};
