<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->decimal('rating', 11, 2)->comment('ความกว้างของอาคาร');
            $table->text('comment')->nullable();
            $table->integer('review_approval')->comment('สถานะการใช้งาน (0 = รออนุมัติ, 1 = อนุมัติแล้ว, 2 = ไม่อนุมัติ)')->default('0');
            $table->integer('review_type')->comment('สถานะ 0 = รีวิวตลาด,1 = รีวิวร้านค้า')->default('0');
            $table->integer('is_delete')->comment('สถานะการลบ (1 = ลบ)')->default('0');
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
        Schema::dropIfExists('reviews');
    }
}
