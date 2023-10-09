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
        {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id'); // Foreign key to link to the users table
                // $table->string('order_number')->unique();
                $table->decimal('total_amount', 10, 2);
                $table->timestamps();

                // Define foreign key constraint
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });

            Schema::create('order_product', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('order_id');
                $table->unsignedBigInteger('product_id');
                $table->integer('quantity');
                $table->decimal('price', 10, 2);
                $table->timestamps();

                // Define foreign key constraints
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
};
