<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('refered_by');
            $table->string('status');
            $table->string('contactperson1');
            $table->string('contactemail1');
            $table->string('contactmobile1');
            $table->string('contactperson2');
            $table->string('contactemail2');
            $table->string('contactmobile2');
            $table->string('place_of_bussiness')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('business_type')->nullable();
            $table->string('currency_type')->nullable();
            $table->string('Lead_date')->nullable();
            $table->string('lead_quality_date')->nullable();
            $table->string('company_id')->nullable();
            $table->string('vat_gst')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('lead_created_by')->nullable();
            $table->string('on_boarding_date')->nullable();
            $table->string('category')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
