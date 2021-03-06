<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            // This should be the date-time for when GENERATING A PAYMENT URL
            // (not when saved to the DB, for that there's created_at -- generated by default in Laravel)
            $table->dateTime('sale_time');
            $table->unsignedInteger('sale_number');
            $table->string('description');
            $table->integer('amount');
            $table->string('currency');
            $table->string('payment_link');
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
        Schema::dropIfExists('sales');
    }
}
