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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->integer('active')->unsigned()->default(1);
            $table->integer('sort')->unsigned()->default(500);
            $table->string('number')->nullable();
            $table->string('img')->nullable();
            $table->string('preview')->nullable();
            $table->string('thumbnail')->nullable();
            $table->decimal('base_price', 10, 2, true)->default(0);
            $table->decimal('price', 10, 2, true)->default(0);
            $table->string('currency')->default('RUB');
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
        Schema::dropIfExists('offers');
    }
};
