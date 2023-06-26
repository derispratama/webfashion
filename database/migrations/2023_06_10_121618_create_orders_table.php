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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('ordercode');

            // Data Customer
            $table->string('name');
            $table->string('id_customer');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            
            // Alamat
            $table->string("address");
            $table->integer("id_province");
            $table->string("province");
            $table->integer("id_city");
            $table->string("city");
            $table->integer("id_suburb");
            $table->string("suburb");
            $table->integer("id_area");
            $table->string("area");
            $table->integer("id_area");
            $table->decimal("lat");
            $table->decimal("lng");
            
            // Shipper
            $table->decimal("weight");
            $table->integer("shipping_cost");
            $table->integer("shipping_insurance_cost");
            $table->string("id_shipper_order");
            $table->string("awb_no");

            // Reserve
            $table->dateTime("start_rent");
            $table->dateTime("end_rent");

            // Pricing
            $table->integer("sub_total");
            $table->integer("total");
            $table->integer("discount");
            $table->integer("deposit");
            $table->integer("fine");

            // Voucher
            $table->integer("id_voucher");
            $table->integer("voucher_name");
            $table->integer("voucher_discount");

            // Payment
            $table->integer("id_payment_method");
            $table->string("payment_method_name");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
