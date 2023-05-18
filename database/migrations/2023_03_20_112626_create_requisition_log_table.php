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
        Schema::create('requisition_log', function (Blueprint $table) {
            $table->increments('requisition_log_id');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('product');

            $table->tinyInteger('product_mode');
            $table->integer('quantity');
            $table->string('reference',200)->nullable();
            $table->integer('user_ref');

            $table->tinyInteger('status')->default(1);
            $table->timestamp('requisition_date')->nullable();
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisition_log');
    }
};
