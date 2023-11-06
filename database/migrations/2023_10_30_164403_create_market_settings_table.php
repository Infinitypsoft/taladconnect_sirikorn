<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_settings', function (Blueprint $table) {
            $table->id();
            $table->float('Latitude', 50)->nullable();
            $table->float('Longtitude', 50)->nullable();
            $table->string('Province', 50)->nullable();
            $table->string('Amphoe', 50)->nullable();
            $table->string('distict', 50)->nullable();
            $table->string('Road', 50)->nullable();
            $table->string('Address', 50)->nullable();
            $table->string('Postal', 5)->nullable();

            $table->string('Market_name', 100)->nullable();
            $table->integer('Owner_type')->nullable();
            $table->integer('Area_size')->nullable();
            $table->integer('Parking')->nullable();
            $table->string('Business_time',255)->nullable();
            $table->string('Business_day',255)->nullable();
            $table->integer('Product_type')->nullable();
            $table->integer('Selling_type')->nullable();
            $table->integer('Rental_type')->nullable();
            $table->integer('Space_Usage')->nullable();
            $table->integer('Total_Space')->nullable();
            $table->integer('Total_Shop')->nullable();

            $table->string('Owner_name', 50)->nullable();
            $table->string('Co-ordinator_name', 50)->nullable();
            $table->string('Mobile_number', 50)->nullable();
            $table->string('Website', 50)->nullable();

            $table->timestamp('Register_date')->nullable();
            $table->timestamp('Update_date')->nullable();
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
        Schema::dropIfExists('market_settings');
    }
}
