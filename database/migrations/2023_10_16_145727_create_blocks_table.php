<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->integer('site_id')->comment('id ตาราง sites ว่าบล้อคนี้อยู่ตึกไหน')->nullable();
            $table->integer('tennant_member_id')->comment('id ตาราง tennant_member ว่าใครเป็นคน เช่า บล้อค นี้อยู่')->nullable();
            $table->string('block_name',255)->nullable();
            $table->integer('stall_size_id')->comment('id ตาราง stall ว่าบล้อคนี้ ขนาดเท่าไหร่')->nullable();
            $table->text('arr_index')->nullable();
            $table->text('detail')->nullable();
            $table->integer('status')->comment('สถานะการใช้งาน (0 = ว่างให้เช่า, 1 = ปล่อยเช่าแล้ว, 2 = ปล่อยเช่าแล้วควบแผง, 3 = ไม่เปิดให้เช่า)')->default('0');
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
        Schema::dropIfExists('blocks');
    }
}
