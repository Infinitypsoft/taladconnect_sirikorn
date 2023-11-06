<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_blocks', function (Blueprint $table) {
            $table->id();
            $table->integer('old_contract_id')->comment('id ของ contract_blocks กรณีนำสัญญาเก่ามาต่อสัญญ่าเป็นฉบับใหม่')->nullable();
            $table->string('doc_code', 255)->comment('code เอกสาร')->nullable();
            $table->integer('tennant_member_id')->comment('id ตาราง tennant_member')->nullable();
            $table->string('tennant_name', 255)->comment('ชื่อผู้เช่า')->nullable();
            $table->string('personal_id', 13)->nullable();
            $table->string('tel', 10)->nullable();
            $table->text('address')->nullable();
            // $table->text('block_list_id')->comment('ไอดี ของ ตาราง block')->nullable();
            $table->date('date_start')->comment('วันที่เริ่มต้นสัญญา')->nullable();
            $table->date('date_end')->comment('วันที่สิ้นสุดสัญญา')->nullable();
            $table->decimal('annual_fee', 12, 2)->comment('ค่าธรรมเนียมรายปี')->default('0');
            $table->decimal('annual_fee_discount', 12, 2)->comment('ส่วนลดค่าธรรมเนียมรายปี')->default('0');
            $table->decimal('insurance_cost', 12, 2)->comment('ค่าประกันการเช่าและบริการ')->default('0');
            $table->decimal('insurance_discount', 12, 2)->comment('ส่วนลดค่าประกันการเช่าและบริการ')->default('0');
            $table->decimal('guarantee_water_rate', 12, 2)->comment('อัตราค่าประกันมิเตอร์น้ำ')->default('0');
            $table->decimal('guarantee_water_rate_discount', 12, 2)->comment('ส่วนลดอัตราค่าประกันมิเตอร์น้ำ')->default('0');
            $table->decimal('guarantee_electricity_rate', 12, 2)->comment('อัตราค่าประกันมิเตอร์น้ำ')->default('0');
            $table->decimal('guarantee_electricity_rate_discount', 12, 2)->comment('ส่วนลดอัตราค่าประกันมิเตอร์น้ำ')->default('0');
            $table->decimal('guarantee_hood_rate', 12, 2)->comment('อัตราค่าประกันเครื่องดูดควัน')->default('0');
            $table->decimal('guarantee_hood_rate_discount', 12, 2)->comment('ส่วนลดอัตราค่าประกันเครื่องดูดควัน')->default('0');
            $table->decimal('rent_cost', 12, 2)->comment('ค่าเช่า')->default('0');
            $table->decimal('rent_discount', 12, 2)->comment('สดค่าเช่า')->default('0');
            $table->decimal('common_fee', 12, 2)->comment('ค่าส่วนกลาง')->default('0');
            $table->decimal('common_fee_discount', 12, 2)->comment('ส่วนลดค่าส่วนกลาง')->default('0');
            $table->decimal('other_cost', 12, 2)->comment('ค่าอื่นๆ')->default('0');
            $table->decimal('other_discount', 12, 2)->comment('ส่วนลดค่าอื่นๆ')->default('0');
            $table->integer('tax_status')->comment('0 = คิดภาษีรวมใน 1 = ภาษีรวมนอก 2 = ไม่คิดภาษี ')->default('0');
            $table->decimal('tax_cost', 12, 2)->comment('เปอเซนภาษี')->default('0');
            $table->decimal('vat_cost', 12, 2)->comment('ภาษีหัก ณ ที่จ่าย')->default('0');
            $table->decimal('total', 12, 2)->comment('ยอดเงินทั้งหมด')->default('0');
            $table->integer('line_status')->comment('0 = ไม่ส่งอัตโนมัติ 1 = ส่งอัตโนมัติ')->default('0');
            $table->integer('send_type')->comment('รอบการส่งบิลเรียกเก็บ 0 = รายวัน | 1 = รายสัปดาห์ | 2 = รายเดือน | 3 = รายปี')->default('0');
            $table->integer('date_send')->comment('send_type = 1 ใช้เงื่อนไขอันนี้เช็ค 0 = วันอาทิตย์ 1 = จันทร์ ... 6 = วันเสาร์ | send_type = 2 ใช้เงื่อนไขอันนี้เช็ค  วันที่ 15,20,25  0 คือ วันสุดท้ายของเดือน | send_type = 3 เก็บวันที่')->nullable();
            $table->integer('month_send')->comment('send_type = 3 จะเก็บเดือน')->nullable();
            $table->integer('doc_type')->comment('ชนิดเอกสาร (0 = เอกสารร่าง, 1 = ยืนยันการเช่า , 2 = ชำระเงินมัดจำแล้ว)')->default('0');
            $table->date('date_confirm')->comment('วันที่ที่คอนฟิม ยืนยันการเช่า')->nullable();
            $table->integer('status')->comment('สถานะการใช้งาน (0 = สัญญาปกติ , 1 = หมดสัญญา  ,2 = หมดสัญญาแล้วไปต่อสัญญาใหม่แล้ว)')->default('0');
            $table->integer('user_edit')->comment('ใครเป็นคนแก้')->default('1');
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
        Schema::dropIfExists('contract_blocks');
    }
}
