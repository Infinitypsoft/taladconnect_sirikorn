<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MeterWaterSite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_water_bill_sites', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id')->nullable();
            $table->string('site_name',255)->nullable();
            $table->integer('site_id')->nullable();
            $table->integer('block_total')->comment('จำนวนแผง')->nullable();
            $table->integer('block_save')->comment('บันทึกแล้ว')->nullable();
            $table->integer('block_wait')->comment('ยังไม่ได้บันทึก')->nullable();
            $table->integer('status')->comment('0 = ยังไม่ครบ 1 = ครบ')->nullable();
            $table->integer('is_delete')->comment('สถานะการลบ (1 = ลบ)')->default('0');
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
        Schema::dropIfExists('meter_water_bill_sites');
    }
}
