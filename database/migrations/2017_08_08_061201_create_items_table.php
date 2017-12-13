<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
          $table->increments('id');
          $table->string('bnumber')->unique();
          $table->string('itemname')->unique();
          $table->integer('openstock');
          $table->integer('minstock');
          $table->boolean('isactive')->default(false);
          $table->boolean('notforsale')->default(false);
          $table->boolean('ispurchased')->default(false);
          $table->boolean('online')->default(false);
          // $table->string('suppname');
          $table->string('categoryname');
          $table->string('subcategoryname');
          $table->string('desc')->nullable();
          $table->string('featured_image');
          $table->decimal('mrp',8,2);
          $table->string('disc1');
          $table->string('disc2');
          $table->decimal('discvalue',8,2);
          $table->decimal('finalprice',8,2);
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
        Schema::dropIfExists('items');
    }
}
