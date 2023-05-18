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
        Schema::create('purchase_cart', function (Blueprint $table) {
            $table->id('purchase_cart_id');
            $table->integer('product_id');
            $table->string('product_name',100);
            $table->integer('quantity')->default(1);
            $table->integer('user_id');
            $table->date('purchase_date')->nullable();
            $table->date('created_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_cart');
    }
};
