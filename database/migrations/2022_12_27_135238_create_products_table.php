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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->string('meta_title');
            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->float('weight')->nullable();
            $table->float('volume')->nullable();
            $table->integer('size');
            $table->string('color', 50);
            $table->integer('stock');
            $table->enum('isReadyPublish', ['ready', 'not ready']);
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
        Schema::dropIfExists('products');
    }
};
