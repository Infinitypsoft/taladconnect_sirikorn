<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('stalls', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('type')->comment('ประเภทแผงค้า 0 = ')->nullable();
            $table->string('pic', 255)->nullable();
            $table->string('pic_path', 255)->nullable();
            $table->decimal('size_w', 12, 2)->comment('ขนาดแผงค้า ความกว้าง')->default('0.00');
            $table->decimal('size_h', 12, 2)->comment('ขนาดแผงค้า ความยาว')->default('0.00');
            $table->integer('radio_annual_fee')->comment('0 = ฟรี, 1 = ไม่ฟรี')->default('0');
            $table->decimal('annual_fee', 12, 2)->comment('ค่าธรรมเนียมรายปี (บาท)')->default('0.00');
            $table->string('color_stall', 10)->comment('สีขนาดแผงค้า')->nullable();
            $table->string('color_table', 10)->comment('สีข้อความที่จะแสดงในตาราง')->nullable();

            $table->decimal('guarantee_service_rate', 12, 2)->comment('อัตราค่าประกันการเช่าและบริการ')->default('0.00');
            $table->decimal('guarantee_water_rate', 12, 2)->comment('อัตราค่าประกันมิเตอร์น้ำ')->default('0.00');
            $table->decimal('guarantee_electricity_rate', 12, 2)->comment('อัตราค่าประกันมิเตอร์ไฟ')->default('0.00');
            $table->string('guarantee_hood_rate', 10)->comment('อัตราค่าประกันเครื่องดูดควัน')->default('-');

            

            // $table->decimal('cost_center_rental_rate_min', 12, 2)->comment('อัตราค่าเช่ารวมส่วนกลาง')->default('0.00');
            // $table->decimal('cost_center_rental_rate_max', 12, 2)->comment('อัตราค่าเช่ารวมส่วนกลาง')->default('0.00');
            $table->decimal('cost_rental_rate', 12, 2)->comment('อัตราค่าเช่า')->default('0.00');
            $table->decimal('cost_common_rate', 12, 2)->comment('อัตราค่าส่วนกลาง')->default('0.00');
            $table->decimal('cost_water_unit_rate', 12, 2)->comment('อัตราค่าน้ำ/ยูนิต')->default('0.00');
            $table->decimal('cost_electricity_unit_rate', 12, 2)->comment('อัตราค่าไฟ/ยูนิต')->default('0.00');
            
            // $table->decimal('vinyl_light_set_min', 12, 2)->comment('อัตราค่าป้ายไวนิล-ป้ายไฟ/ชุด')->default('0.00');
            // $table->decimal('vinyl_light_set_max', 12, 2)->comment('อัตราค่าป้ายไวนิล-ป้ายไฟ/ชุด')->default('0.00');
            // $table->decimal('water_sync_rate', 12, 2)->comment('อัตราค่าซิงค์น้ำ')->default('0.00');
            // $table->decimal('grease_tank_rate', 12, 2)->comment('อัตราค่าถังตักไขมัน')->default('0.00');

            $table->integer('status')->comment('สถานะการใช้งาน (0 = ปิดการใช้งาน, 1 = เปิดการใช้งาน)')->default('1');
            $table->integer('is_delete')->comment('สถานะการลบ (1 = ลบ)')->default('0');
            $table->integer('user_edit')->comment('ใครเป็นคนแก้')->default('1');
            
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
        Schema::dropIfExists('stalls');
    }
}
