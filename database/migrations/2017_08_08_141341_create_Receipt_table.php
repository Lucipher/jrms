<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hdpos_receipt', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('userid');
            $table->string('invoicenumber');
            $table->string('invoicedate');
            $table->string('totalproduct');
            $table->string('totalquantity');
            $table->string('amount');
            $table->string('spotdiscountpercent')->nullable();
            $table->string('spotdiscountamount')->nullable();
            $table->string('totalamount');
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
       Schema::dropIfExists('hdpos_receipt');
    }
}

