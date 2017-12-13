
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('hdpos_receiptitems', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('receiptid');
            $table->string('itemid');
            $table->decimal('amount');
            $table->string('quantity');
            $table->decimal('discount')->nullable();
            $table->string('discountchkbox')->nullable();
            $table->string('spotdiscountchkbox')->nullable();
            $table->string('spotdiscountpercent')->nullable();
            $table->string('spotdiscountamount')->nullable();
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
        Schema::dropIfExists('hdpos_receiptitems');
    }
}