<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id')->comment('Bill id');
            $table->integer('bill_list_id')->comment('ลำดับ');
            $table->string('list_name', 255)->nullable();
            $table->decimal('price_unit', 12, 2)->comment('ราคาต่อหน่วย')->nullable();
            $table->integer('num')->comment('จำนวนต่อรายการ')->default('0');
            $table->decimal('list_total_price')->comment('ราคารวมต่อรายการ')->default('0.00');
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
        Schema::dropIfExists('bill_lists');
    }
}
