<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name',200)->unique();

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('category');

            $table->unsignedInteger('store_id');
            $table->foreign('store_id')->references('store_id')->on('store');

            $table->unsignedInteger('unite_id');
            $table->foreign('unite_id')->references('unite_id')->on('unite');

            $table->string('barcode')->nullable(); // unique

            $table->tinyInteger('status')->default(1);
            $table->integer('creator');
            $table->integer('modifier');
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('modified_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
