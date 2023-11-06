<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MeterWaterBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_water_bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_code')->comment('รหัสบิล')->nullable();
            $table->string('bill_name')->comment('ชื่อบิล')->nullable();
            $table->date('start_date')->nullable()->comment('วันที่เริ่มต้น');
            $table->date('end_date')->nullable()->comment('วันที่สิ้นสุด');
            $table->date('line_noti_date')->nullable()->comment('วันที่แจ้งเตือน');
            $table->integer('vat_status')->comment('0 = ไม่คิดภาษี 1 = คิดภาษี')->default('0');
            $table->decimal('total', 12, 2)->comment('ความกว้างของอาคาร')->nullable()->default('0');
            $table->decimal('total_paid', 12, 2)->comment('ชำระแล้ว')->nullable()->default('0');
            $table->decimal('total_overdue', 12, 2)->comment('ค้างชำระ')->nullable()->default('0');
            $table->integer('vat')->comment('0 = ไม่คิดภาษี 1 = คิดภาษี')->default('0');
            $table->integer('charge')->comment('หัก ณ ที่จ่าย')->default('0');
            $table->integer('user_id')->comment('ไอดีผู้สร้าง')->nullable();
            $table->integer('status')->comment('0 = ร่าง 1 = ดำเนินการ 2 = สำเร็จ 3 = ยกเลิก')->nullable()->default('0');
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
        Schema::dropIfExists('meter_water_bills');
    }
}
