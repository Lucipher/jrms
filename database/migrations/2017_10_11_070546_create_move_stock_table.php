<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoveStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movestock', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->string('product_id');
            $table->string('barcode');
            $table->string('from_location');
            $table->string('to_location')->nullable();
            $table->integer('quantity')->unsigned();
            $table->string('notes')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('movestock');
    }
}
