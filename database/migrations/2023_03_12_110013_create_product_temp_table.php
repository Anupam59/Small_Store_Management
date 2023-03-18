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
        Schema::create('product_temp', function (Blueprint $table) {
            $table->increments('product_temp_id');
            $table->integer('product_id');

            $table->tinyInteger('product_mode')->nullable();
            $table->integer('quantity');
            $table->string('reference',200);
            $table->integer('user_ref')->nullable();
            $table->integer('temp_invoice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_temp');
    }
};
