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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("address");
            $table->integer("province_id");
            $table->string("province");
            $table->integer("city_id");
            $table->string("city");
            $table->integer("suburb_id");
            $table->string("suburb");
            $table->integer("area_id");
            $table->string("area");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
