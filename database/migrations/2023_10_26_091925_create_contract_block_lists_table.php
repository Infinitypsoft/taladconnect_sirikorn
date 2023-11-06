<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractBlockListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_block_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_block_id')->comment('id ของ contract_blocks')->nullable();
            $table->integer('block_id')->comment('id ตาราง block')->nullable();
            $table->string('block_name', 255)->comment('ชื่อ ของแผง ณ ตอนเช่า')->nullable();
            $table->integer('stall_size_id')->comment('id ตาราง stall')->nullable();
            $table->string('stall_size_name', 255)->comment('ชื่อ ขนาดแผง ณ ตอนเช่า')->nullable();
            $table->decimal('annual_fee', 12, 2)->comment('ค่าธรรมเนียมรายปี')->default('0');
            $table->decimal('insurance_cost', 12, 2)->comment('ค่าประกันการเช่าและบริการ')->default('0');
            $table->decimal('guarantee_water_rate', 12, 2)->comment('อัตราค่าประกันมิเตอร์น้ำ')->default('0');
            $table->decimal('guarantee_electricity_rate', 12, 2)->comment('อัตราค่าประกันมิเตอร์น้ำ')->default('0');
            $table->decimal('guarantee_hood_rate', 12, 2)->comment('อัตราค่าประกันเครื่องดูดควัน')->default('0');
            $table->decimal('rent_cost', 12, 2)->comment('ค่าเช่า')->default('0');
            $table->decimal('common_fee', 12, 2)->comment('ค่าส่วนกลาง')->default('0');
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
        Schema::dropIfExists('contract_block_lists');
    }
}
