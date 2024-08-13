<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationQuoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->tinyInteger('location_id')->nullable();
        });
        Schema::table('shoppings', function (Blueprint $table) {
            $table->tinyInteger('location_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('muestras', function (Blueprint $table) {
            $table->date('location_id')->nullable();
        });
        Schema::table('shoppings', function (Blueprint $table) {
            $table->date('location_id')->nullable();
        });
    }
}
