<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            
            $table->string('pic', 255)->nullable();
            $table->string('pic_path', 255)->nullable();

            $table->string('market_name_thai',255)->nullable();
            $table->string('market_name_eng',255)->nullable();
            $table->string('company_name',255)->nullable();
            $table->string('identification_number',255)->nullable();

            
            $table->string('address_thai',255)->nullable();
            $table->string('address_eng',255)->nullable();
            $table->string('address_link',255)->nullable();

            $table->string('phone', 10)->nullable();
            $table->string('email',255)->nullable();
            $table->string('facebook',255)->nullable();
            $table->string('facebook_link',255)->nullable();
            $table->string('id_line',255)->nullable();
            $table->string('id_line_link',255)->nullable();
            $table->string('instagram',255)->nullable();
            $table->string('instagram_link',255)->nullable();
            $table->string('tiktok',255)->nullable();
            $table->string('tiktok_link',255)->nullable();

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
        Schema::dropIfExists('contacts');
    }
}
