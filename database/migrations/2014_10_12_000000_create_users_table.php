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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('email')->unique();
            $table->string('number')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('user_image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('dept_admin',500)->nullable();
            $table->string('dept_ao',500)->nullable();
            $table->string('store_manager',500)->nullable();
            $table->string('store_manager',500)->nullable();

            $table->tinyInteger('role')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('creator')->nullable();
            $table->tinyInteger('modifier')->nullable();
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
        Schema::dropIfExists('users');
    }
};
