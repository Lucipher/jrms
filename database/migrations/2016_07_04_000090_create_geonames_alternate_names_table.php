<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeonamesAlternateNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geonames_alternate_names', function (Blueprint $table) {
            $table->integer('alternate_name_id')->primary()->unsigned();
            $table->integer('geoname_id')->index()->unsigned();
            $table->foreign('geoname_id')->references('geoname_id')->on('geonames_geonames')->onUpdate('cascade')->onDelete('cascade');
            $table->string('iso_language', 7)->nullable();
            $table->string('alternate_name', 400)->nullable();
            $table->boolean('isPreferredName');
            $table->boolean('isShortName');
            $table->boolean('isColloquial');
            $table->boolean('isHistoric');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('geonames_alternate_names');
    }
}
