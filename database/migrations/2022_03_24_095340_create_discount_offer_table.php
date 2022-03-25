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
        Schema::create('discount_offer', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('offer_id')->unsigned();
            $table->BigInteger('photo_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_offer');
    }
};
