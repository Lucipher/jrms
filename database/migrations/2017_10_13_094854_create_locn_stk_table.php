<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocnStkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_stock', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location');

        });

        DB::table('location_stock')->insert([
          array( 'location' =>'ADAMBAKKAM'),
          array( 'location' =>'ALANGULAM'),
          array( 'location' =>'AMBATTUR'),
          array( 'location' =>'ARKKONAM'),
          array( 'location' =>'AUSTRALIA'),
          array( 'location' =>'CALIFORNIA'),
          array( 'location' =>'CANADA'),
          array( 'location' =>'CHANDIGARH'),
          array( 'location' =>'CHENGALPATTU'),
          array( 'location' =>'COCHIN'),
          array( 'location' =>'COIMBATORE'),
          array( 'location' =>'CUDDALORE'),
          array( 'location' =>'DELHI'),
          array( 'location' =>'DHARMAPURAI'),
          array( 'location' =>'DUBAI'),
          array( 'location' =>'ERODE'),
          array( 'location' =>'FRAZER TOWN'),
          array( 'location' =>'HASSAN'),
          array( 'location' =>'HOSUR'),
          array( 'location' =>'HYDERABAD'),
          array( 'location' =>'KANCHIPURAM'),
          array( 'location' =>'KARAIKUDI'),
          array( 'location' =>'KOTTAYAM'),
          array( 'location' =>'KRISHNAGIRI'),
          array( 'location' =>'MADURAI'),
          array( 'location' =>'MADURAI - 2'),
          array( 'location' =>'MALAYSIA'),
          array( 'location' =>'MARTHANDAM'),
          array( 'location' =>'MARYLAND'),
          array( 'location' =>'MOUNT ROAD'),
          array( 'location' =>'MUMBAI - DHARAVI'),
          array( 'location' =>'MUMBAI -MALAD'),
          array( 'location' =>'MUMBAI-BHANDUP'),
          array( 'location' =>'MYSORE'),
          array( 'location' =>'NAGERCOIL'),
          array( 'location' =>'NALUMAVADI'),
          array( 'location' =>'NAMAKKAL'),
          array( 'location' =>'NEWZEALAND'),
          array( 'location' =>'OOTY'),
          array( 'location' =>'PALAYAMKOTTAI'),
          array( 'location' =>'PERAMBALUR'),
          array( 'location' =>'PONDICHERRY'),
          array( 'location' =>'PRAYER MOUNTAIN'),
          array( 'location' =>'PURASAWALKAM'),
          array( 'location' =>'RANCHI'),
          array( 'location' =>'ROYAPURAM'),
          array( 'location' =>'SALEM'),
          array( 'location' =>'SANKARANKOIL'),
          array( 'location' =>'SHANTHI NILAIYAM'),
          array( 'location' =>'SHIVAJI NAGAR'),
          array( 'location' =>'SINGAPORE'),
          array( 'location' =>'SIVAKASI'),
          array( 'location' =>'SRILANKA (COLOMBU)'),
          array( 'location' =>'SRILANKA (KILINOCHI)'),
          array( 'location' =>'SURANDAI'),
          array( 'location' =>'TAMBARAM'),
          array( 'location' =>'TANJORE'),
          array( 'location' =>'THENI'),
          array( 'location' =>'THIRUKCONAMALAI'),
          array( 'location' =>'THIRUTTANI'),
          array( 'location' =>'THIRUVALLORE'),
          array( 'location' =>'THIRUVANNAMALAI'),
          array( 'location' =>'THIRUVARUR'),
          array( 'location' =>'THISAYANVILAI'),
          array( 'location' =>'THOOTHUKUDI'),
          array( 'location' =>'TIRUPUR'),
          array( 'location' =>'TRICHY THENNUR'),
          array( 'location' =>'TRICHY THILLAI NAGAR'),
          array( 'location' =>'TRIVANDRUM'),
          array( 'location' =>'VELANKANNI'),
          array( 'location' =>'VELLORE'),
          array( 'location' =>'VILLUPURAM'),


   ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_stock');
    }
}
