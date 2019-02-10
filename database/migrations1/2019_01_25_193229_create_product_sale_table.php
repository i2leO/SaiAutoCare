<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_saled_logs', function (Blueprint $table) {

            $table->increments('id');
            $table->string('job_id');
            $table->string('customer_id');
            $table->string('sale_id');
            $table->string('product_id');
            $table->string('product_hsn');
            $table->float('product_price_without_gst',100,5);
            $table->float('product_price_with_gst',100,5);
            $table->float('product_gst',100,5);
            $table->float('product_quantity',100,5);
            $table->float('product_discount',100,5);
            $table->float('product_total_price',100,5);
            $table->string('notes')->nullable();        
            $table->SoftDeletes();
            $table->timestamps();

            // $table->increments('id');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_saled_logs');
    }
}
