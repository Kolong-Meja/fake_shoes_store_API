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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->float('price');
            $table->integer('quantity');
            $table->float('sub_total');
            $table->float('shipping');
            $table->float('total');
            $table->string('user_name');
            $table->string('user_email');
            $table->char('user_mobile', 13);
            $table->string('address');
            $table->string('city', 100);
            $table->string('province', 100);
            $table->string('country', 100);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
