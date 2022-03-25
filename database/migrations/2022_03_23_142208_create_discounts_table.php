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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
			$table->string('name', 100);
            $table->integer('active')->unsigned()->default(1);
            $table->integer('sort')->unsigned()->default(10);
            $table->string('type');
            $table->string('kind')->default('percent');
            $table->unsignedInteger('value');
            $table->json('categories')->nullable();
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
        Schema::dropIfExists('discounts');
    }
};
