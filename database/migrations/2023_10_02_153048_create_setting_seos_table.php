<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_seos', function (Blueprint $table) {
            $table->id();
            $table->text('keyword')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('user_edit')->comment('ใครเป็นคนแก้')->nullable();
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
        Schema::dropIfExists('setting_seos');
    }
}
