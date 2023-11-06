<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToContractBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_blocks', function (Blueprint $table) {
            //
            $table->integer('pay_type')->comment('ชนิดการจ่ายเงินมัดจำ 0 = เงินสด , 1 = เงินโอน')->default('0')->after('month_send');
            $table->string('slip', 255)->comment('รูป สลิป')->nullable()->after('pay_type');
            $table->string('slip_path', 255)->comment('รูป สลิป')->nullable()->after('slip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_blocks', function (Blueprint $table) {
            //
        });
    }
}
