<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_id', 13)->comment('Bill ID')->nullable();
            $table->date('date_receipt_money')->comment('วันที่รับเงิน')->nullable();
            $table->string('customer_name', 255)->nullable();
            $table->string('tel', 10)->nullable();
            $table->text('address')->nullable();
            $table->string('payee_name', 255)->comment('ผู้รับเงิน')->nullable();
            $table->decimal('total_price', 12, 2)->comment('ยอดเงิน')->nullable();
            $table->integer('user_create')->comment('ผู้สร้าง')->default('1');
            $table->integer('status')->comment('การยกเลิก (0 = ปกติ , 1 = ยกเลิก)')->default('0');
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
        Schema::dropIfExists('bills');
    }
}
