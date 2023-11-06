<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            
            $table->string('title_thai',255)->nullable();
            $table->string('sub_title_thai',255)->nullable();
            $table->text('description_thai')->nullable();

            $table->string('title_eng',255)->nullable();
            $table->string('sub_title_eng',255)->nullable();
            $table->text('description_eng')->nullable();

            $table->text('keyword')->nullable();
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('pic', 255)->nullable();
            $table->string('pic_path', 255)->nullable();

            $table->integer('status')->comment('สถานะการใช้งาน (0 = ปิดการใช้งาน, 1 = เปิดการใช้งาน)')->default('1');
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
        Schema::dropIfExists('contents');
    }
}
