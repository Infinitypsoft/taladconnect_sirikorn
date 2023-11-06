<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_infos', function (Blueprint $table) {
            $table->id();
            $table->string('title_thai',255)->nullable();
            $table->string('title_eng',255)->nullable();
            $table->text('description_thai')->nullable();
            $table->text('description_eng')->nullable();
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
        Schema::dropIfExists('gallery_infos');
    }
}
