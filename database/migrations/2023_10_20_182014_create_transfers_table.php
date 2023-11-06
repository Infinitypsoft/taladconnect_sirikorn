<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('pic', 255)->nullable();
            $table->string('pic_path', 255)->nullable();
            $table->string('bank_name', 255)->nullable();
            $table->string('bank_number', 255)->nullable();
            $table->string('account_name', 255)->nullable();
            $table->integer('status')->comment('สถานะการใช้งาน (0 = ปิดการใช้งาน, 1 = เปิดการใช้งาน)')->default('1');
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
        Schema::dropIfExists('transfers');
    }
}
