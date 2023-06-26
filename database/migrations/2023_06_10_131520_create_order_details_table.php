<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer("id_order");

            // Product
            $table->integer("id_product");
            $table->string("product_name");

            $table->integer("id_size");
            $table->string("size_name");
            $table->string("custom_size");

            $table->integer("id_color");
            $table->string("color_name");
            $table->string("product_image");
            
            // Pricing
            $table->integer("qty");
            $table->integer("price");
            $table->integer("discount");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
