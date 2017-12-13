<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('salutation')->nullable();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('address4')->nullable();
            $table->string('district')->nullable();
            $table->string('pincode');
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile1')->nullable();
            $table->string('mobile2')->nullable();
            $table->string('email')->nullable();
            $table->string('bday')->nullable();
            $table->string('wday')->nullable();
            $table->string('occupation')->nullable();
            $table->string('nameofchurch')->nullable();
            $table->string('language')->nullable();
            $table->string('addressyear');
            $table->string('mode')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('address');
    }
}
