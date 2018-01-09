<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addstock', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->string('product_id');
            $table->string('barcode');
            $table->string('location')->nullable();
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
        Schema::dropIfExists('addstock');
    }
}
