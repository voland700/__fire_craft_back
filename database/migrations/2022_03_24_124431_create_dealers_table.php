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
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->bigInteger('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->string('mail')->nullable();
            $table->string('address')->nullable();
            $table->string('time')->nullable();
            $table->string('site')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
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
        Schema::dropIfExists('dealers');
    }
};
