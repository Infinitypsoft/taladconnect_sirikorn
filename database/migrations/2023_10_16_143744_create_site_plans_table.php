<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('site_plans', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('site_id')->comment('id ตาราง sites')->nullable();
        //     $table->integer('block_id')->comment('id ตาราง block')->nullable();
        //     $table->integer('is_delete')->comment('สถานะการลบ (1 = ลบ)')->default('0');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('site_plans');
    }
}
