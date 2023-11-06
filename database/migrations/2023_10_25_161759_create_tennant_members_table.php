<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTennantMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tennant_members', function (Blueprint $table) {
            $table->id();
            $table->string('tennant_code', 255)->comment('code ผู้เช่า')->nullable();
            $table->integer('tennant_type')->comment('ประเภทของบุคคล (0 = บุคคลธรรมดา, 1 = นิติบุคคล)')->default('1');
            $table->integer('vat_type')->comment('ภาษี 0 = รวมใน 1 = รวมนอก 2=ไม่คิดภาษี')->default('1');
            $table->string('title_name', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('personal_id', 13)->nullable();
            $table->string('company_name', 255)->comment('ชื่อบริษัท')->nullable();
            $table->string('tax_number', 13)->comment('เลขเสียภาษี')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('tel', 10)->nullable();
            $table->text('address')->nullable();
            $table->string('token_line', 255)->nullable();
            $table->integer('register_type')->comment('การสมัคร (0 = สมัครจากline, 1 = แอดมินเพิ่มให้)	')->default('1');
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
        Schema::dropIfExists('tennant_members');
    }
}
