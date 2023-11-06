<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TennantMemberElectricTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tennant_member_electrics', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id')->comment('เลขที่บิล')->nullable();
            $table->string('bill_code')->comment('เลขที่บิล')->nullable();
            $table->string('member_name', 255)->comment('ชื่อผู้เช่า')->nullable();
            $table->string('user_id', 255)->comment('ชื่อผู้เช่า')->nullable();
            $table->string('site_id', 255)->comment('รหัสอาคาร')->nullable();
            $table->string('block_list', 255)->comment('แผ่งเช่า')->nullable();
            $table->decimal('unit_total', 10,2)->comment('ยูนิตรวม')->nullable();
            $table->decimal('total', 10,2)->comment('ยูนิตรวม')->nullable();
            $table->integer('status')->comment('0 = ค้างชำระ 1 = ชำระแล้ว')->nullable();
            $table->integer('pay_status')->comment('0 = ยังไม่ได้ชำระ 1 = จุดชำระเงินของตลาด 2 = Line OA')->nullable()->default('0');
            $table->integer('confirm_status')->comment('0 = ยังไม่ได้ชำระ 1 = จุดชำระเงินของตลาด')->nullable()->default('0');
            $table->integer('noti_status')->comment('0 = ไม่ได้รับการแจ้งเตือน 1 = ได้รับการแจ้งเตือน')->nullable()->default('0');
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
        Schema::dropIfExists('tennant_member_electrics');
    }
}
