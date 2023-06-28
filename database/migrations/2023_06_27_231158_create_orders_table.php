<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
          $table->string('company', 255);
          $table->string('name', 255);
          $table->string('street', 255);
          $table->string('zip', 25);
          $table->string('city', 255);
          $table->string('email');
          $table->integer('plate_front')->nullable();
          $table->integer('plate_back')->nullable();
          $table->integer('flag')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
