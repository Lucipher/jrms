<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hdpos_invoice', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('invoicenumber');
            $table->string('invoicedate');
            $table->string('itemid');
            $table->decimal('amount');
            $table->string('quantity');
            $table->decimal('discount')->nullable();
            $table->string('discountchkbox')->nullable();
            $table->string('spotdiscountchkbox')->nullable();
            $table->string('spotdiscountpercent')->nullable();
            $table->string('spotdiscountamount')->nullable();
            $table->string('status');
            $table->string('createdby');
            $table->string('modifiedby');
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
        Schema::dropIfExists('hdpos_invoice');
    }
}













