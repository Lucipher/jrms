<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier');
            $table->string('door_number');
            $table->string('street');
            $table->string('area');
            $table->string('city');
            $table->string('district');
            $table->string('state');
            $table->string('country');
            $table->string('pincode');
            $table->string('mobile');
            $table->string('email');
            $table->string('notes')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('suppliers');
    }
}
