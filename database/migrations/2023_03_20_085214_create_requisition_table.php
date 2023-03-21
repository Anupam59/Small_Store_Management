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
        Schema::create('requisition', function (Blueprint $table) {
            $table->bigIncrements('requisition_id');
            $table->string('total_quantity',100)->nullable();

            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('department_id')->on('department');

            $table->integer('approved_by')->nullable();
            $table->timestamp('approved_date')->nullable();

            $table->integer('delivered_by')->nullable();
            $table->timestamp('delivered_date')->nullable();

            $table->integer('canceled_by')->nullable();
            $table->timestamp('canceled_date')->nullable();

            $table->text('note')->nullable();

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
        Schema::dropIfExists('requisition');
    }
};
