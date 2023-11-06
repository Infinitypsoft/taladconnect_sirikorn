<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();

            $table->integer('tennant_member_id')->comment('id tennant_member')->nullable();
            $table->string('pic',255)->nullable();
            $table->string('pic_path',255)->nullable();

            $table->string('store_name', 255)->comment('name thai')->nullable();
            $table->string('store_type', 255)->comment('ชนิดร้านค้า')->nullable();
            $table->string('product_type', 255)->comment('ชนิดสินค้า')->nullable();
            $table->string('description_short',255)->comment('คำอธิบายร้าน โดยย่อ')->nullable();
            $table->text('description',255)->comment('คำอธิบายร้าน')->nullable();

            $table->string('store_name_eng', 255)->nullable();
            $table->string('store_type_eng', 255)->nullable();
            $table->string('product_type_eng', 255)->nullable();
            $table->string('description_short_eng',255)->nullable();
            $table->text('description_eng',255)->nullable();

            $table->decimal('price_min', 12, 2)->comment('ราคาเริ่มต้น')->nullable();
            $table->decimal('price_max', 12, 2)->comment('ราคาสูงสุด')->nullable();
            $table->time('time_open')->comment('เวลาเปิด')->nullable();
            $table->time('time_close')->comment('เวลาเปิด')->nullable();
            $table->string('tel',255)->comment('เบอร์โทร')->nullable();
            $table->string('location',255)->comment('ตำแหน่งที่ตั้ง')->nullable();
            $table->string('facebook',255)->comment('ชื่อ fackbook')->nullable();
            $table->string('facebook_link',255)->comment('facebook link')->nullable();
            $table->string('line',255)->comment('line')->nullable();
            $table->string('line_link',255)->comment('line link')->nullable();
            $table->string('instagram',255)->comment('instagram')->nullable();
            $table->string('instagram_link',255)->comment('instagram link')->nullable();
            $table->string('tiktok',255)->comment('tiktok')->nullable();
            $table->string('tiktok_link',255)->comment('tiktok link')->nullable();

            $table->string('product_1_pic',255)->nullable();
            $table->string('product_1_pic_path',255)->nullable();
            $table->string('product_1_name',255)->comment('ชื่อสิ้นค้าแนะนำ ที่ 1 ')->nullable();
            $table->string('product_1_name_eng',255)->comment('ชื่อสิ้นค้าแนะนำ ที่ 1 ')->nullable();
            $table->decimal('product_1_price', 12, 2)->comment('ราคา')->nullable();
            $table->string('product_1_description',255)->comment('คำอธิบายร้าน')->nullable();
            $table->string('product_1_description_eng',255)->comment('คำอธิบายร้าน')->nullable();

            $table->string('product_2_pic',255)->nullable();
            $table->string('product_2_pic_path',255)->nullable();
            $table->string('product_2_name',255)->comment('ชื่อสิ้นค้าแนะนำ ที่ 2 ')->nullable();
            $table->string('product_2_name_eng',255)->comment('ชื่อสิ้นค้าแนะนำ ที่ 2 ')->nullable();
            $table->decimal('product_2_price', 12, 2)->comment('ราคา')->nullable();
            $table->string('product_2_description',255)->comment('คำอธิบายร้าน')->nullable();
            $table->string('product_2_description_eng',255)->comment('คำอธิบายร้าน')->nullable();

            $table->string('product_3_pic',255)->nullable();
            $table->string('product_3_pic_path',255)->nullable();
            $table->string('product_3_name',255)->comment('ชื่อสิ้นค้าแนะนำ ที่ 3 ')->nullable();
            $table->string('product_3_name_eng',255)->comment('ชื่อสิ้นค้าแนะนำ ที่ 3 ')->nullable();
            $table->decimal('product_3_price', 12, 2)->comment('ราคา')->nullable();
            $table->string('product_3_description',255)->comment('คำอธิบายร้าน')->nullable();
            $table->string('product_3_description_eng',255)->comment('คำอธิบายร้าน')->nullable();

            $table->string('product_4_pic',255)->nullable();
            $table->string('product_4_pic_path',255)->nullable();
            $table->string('product_4_name',255)->comment('ชื่อสิ้นค้าแนะนำ ที่ 4 ')->nullable();
            $table->string('product_4_name_eng',255)->comment('ชื่อสิ้นค้าแนะนำ ที่ 4 ')->nullable();
            $table->decimal('product_4_price', 12, 2)->comment('ราคา')->nullable();
            $table->string('product_4_description',255)->comment('คำอธิบายร้าน')->nullable();
            $table->string('product_4_description_eng',255)->comment('คำอธิบายร้าน')->nullable();
            $table->text('keyword',255)->comment('seo')->nullable();
            $table->text('title',255)->comment('seo')->nullable();
            $table->text('seo_description',255)->comment('seo')->nullable();

            $table->integer('user_edit')->comment('ใครเป็นคนแก้')->nullable();
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
        Schema::dropIfExists('stores');
    }
}
