<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MeterElectricHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_electric_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('meter_id')->comment('มิเตอร์ไอดี')->nullable();
            $table->integer('bill_id')->comment(' บิลไอดี')->nullable();
            $table->integer('site_id')->comment(' ไอดีอาคาร')->nullable();
            $table->string('start_meter')->comment('ค่าไฟเริ่มต้น')->default('000000');
            $table->string('current_meter')->comment('ค่าไฟล่าสุด')->default('000000');
            $table->string('cost_electricity_unit_rate')->comment('ยูนิตค่าไฟ');
            $table->integer('user_id')->comment('ผู้แก้ไข')->nullable();
            $table->integer('block_id')->comment('ไอดีแผง')->nullable();
            $table->string('block_name')->comment('ชื่อแผง')->nullable();
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
        Schema::dropIfExists('meter_electric_histories');
    }
}
