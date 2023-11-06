<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractBlockListDeletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_block_list_deletes', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_block_id')->comment('id ของ contract_blocks')->nullable();
            $table->integer('block_id')->comment('id ตาราง block')->nullable();
            $table->string('block_name', 255)->comment('ชื่อ ของแผง ณ ตอนเช่า')->nullable();
            $table->integer('stall_size_id')->comment('id ตาราง stall')->nullable();
            $table->string('stall_size_name', 255)->comment('ชื่อ ขนาดแผง ณ ตอนเช่า')->nullable();
            $table->decimal('annual_fee', 12, 2)->comment('ค่าธรรมเนียมรายปี')->nullable();
            $table->decimal('insurance_cost', 12, 2)->comment('ค่าประกันการเช่าและบริการ')->nullable();
            $table->decimal('guarantee_water_rate', 12, 2)->comment('อัตราค่าประกันมิเตอร์น้ำ')->nullable();
            $table->decimal('guarantee_electricity_rate', 12, 2)->comment('อัตราค่าประกันมิเตอร์น้ำ')->nullable();
            $table->decimal('guarantee_hood_rate', 12, 2)->comment('อัตราค่าประกันเครื่องดูดควัน')->nullable();
            $table->decimal('rent_cost', 12, 2)->comment('ค่าเช่า')->nullable();
            $table->decimal('common_fee', 12, 2)->comment('ค่าส่วนกลาง')->nullable();
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
        Schema::dropIfExists('contract_block_list_deletes');
    }
}
