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
        Schema::create('currencies', function (Blueprint $table) {				
			$table->string('currency')->unique();
            $table->string('CharCode')->nullable();
            $table->string('Name')->nullable();
            $table->integer('Nominal')->unsigned()->default(1);
            $table->decimal('value', 10, 4, true)->default(NULL);
            $table->string('Date')->nullable();
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
        Schema::dropIfExists('currencies');
    }
};
