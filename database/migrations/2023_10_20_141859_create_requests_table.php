<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->text('detail')->nullable();
            $table->string('note', 255)->nullable();
            $table->integer('status')->comment('สถานะการใช้งาน (0 = รออนุมัติ, 1 = อนุมัติแล้ว, 2 = ไม่อนุมัติ)')->default('0');
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
        Schema::dropIfExists('requests');
    }
}


