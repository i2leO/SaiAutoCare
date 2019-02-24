<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_saled_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_id');
            $table->string('customer_id');
            $table->string('sale_id');
            $table->string('service_id');
            $table->string('product_hsn');
            $table->float('service_price_without_gst',100,5);
            $table->float('ervice_price_with_gst',100,5);
            $table->float('service_gst',100,5);
            $table->float('service_quantity',100,5);
            $table->float('service_discount',100,5);
            $table->float('service_total_price',100,5);
            $table->string('service_notes')->nullable();        
            $table->SoftDeletes();
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
        Schema::dropIfExists('service_saled_logs');
    }
}
