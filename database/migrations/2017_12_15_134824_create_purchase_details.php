<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->string('barcode');
            $table->string('product_id');
            $table->string('supplier');
            $table->string('invoice_number');
            $table->string('billed_date');
            $table->string('received_date');
            $table->string('location');
            $table->integer('quantity')->unsigned();
            $table->string('status');
            $table->string('notes')->nullable();
            $table->string('created_by');
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
        Schema::dropIfExists('purchase_details');
    }
}
