<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('username', 255);
            $table->string('email', 255)->nullable();
            $table->string('tel', 255);
            $table->string('position', 255)->default('-');
            $table->string('password', 255);
            $table->string('pic', 255);
            $table->string('pic_path', 255);
            $table->integer('role')->comment('สิทธิ์การเข้าใช้งานระบบ (0 = user, 1 = admin)')->default('0');
            $table->integer('status')->comment('สถานะการใช้งาน (0 = ปิดการใช้งาน, 1 = เปิดการใช้งาน)')->default('1');
            $table->integer('is_delete')->comment('สถานะการลบ (1 = ลบ)')->default('0');

            // Dashboard
            $table->integer('dashboard_view_report')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');

            // จัดการคำร้อง
            $table->integer('manage_request_view_request')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_request_change_status')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');

            // จัดการการเช่า
            $table->integer('manage_rental_view_rental')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_rental_view_report')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');

            // สมาชิกผู้เช่า
            $table->integer('tenant_member_view_tenant')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('tenant_member_add_tenant')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('tenant_member_edit_tenant')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('tenant_member_publicize_shop')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');

            // การจัดการผู้ใช้งาน
            $table->integer('manage_user_view_user')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_user_add_user')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_user_edit_user')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');

            // จัดการตลาด
            $table->integer('manage_market_view_market')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            
            // จัดการเว็บไซต์ประชาสัมพันธ์
            $table->integer('manage_seo')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_slide_cover')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_article')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_contact')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_review')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_gallery')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');
            $table->integer('manage_reward_standard')->comment('สถานะ (0 = ไม่อนุญาต, 1 = อนุญาต)')->default('0');

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
        Schema::dropIfExists('admins');
    }
}
