<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractBlockSlipListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_block_slip_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_block_id')->comment('id ของ contract_blocks')->nullable();
            $table->string('slip',255)->nullable();
            $table->string('slip_path',255)->nullable();
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
        Schema::dropIfExists('contract_block_slip_lists');
    }
}
