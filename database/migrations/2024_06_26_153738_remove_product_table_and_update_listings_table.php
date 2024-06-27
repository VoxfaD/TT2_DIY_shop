<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProductTableAndUpdateListingsTable extends Migration
{
    public function up()
    {
        // Remove product_id column from listings table
        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            $table->text('description')->nullable(); // Add description column
        });

        // Drop the products table
        Schema::dropIfExists('products');
    }

    public function down()
    {
        // Recreate the products table
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        // Add product_id column back to listings table
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->dropColumn('description'); // Remove description column
        });
    }
}
