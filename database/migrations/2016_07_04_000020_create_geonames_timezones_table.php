<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeonamesTimezonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geonames_timezones', function (Blueprint $table) {
            $table->string('timezone_id', 40)->primary();
            $table->char('country_code', 2)->index();
            // We are adding this constraint from geonames_country_infos migration
            //$table->foreign('country_code')->references('iso')->on('geonames_country_infos')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('gmt_offset', 2, 1);
            $table->decimal('dst_offset', 2, 1);
            $table->decimal('raw_offset', 2, 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('geonames_timezones');
    }
}
