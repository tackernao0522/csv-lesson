<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('combination_id');
            $table->integer('prin');
            $table->integer('chocolate');
            $table->integer('fresh_berries');
            $table->integer('raiins');
            $table->integer('pineapple');
            $table->integer('vanilla_ice_cream');
            $table->integer('brown_rice');
            $table->integer('roasted_soybeans');
            $table->integer('coconut');
            $table->integer('honey');
            $table->integer('miso');
            $table->string('personal_flavor_print_file_name');
            $table->string('personal_top_flavor_1');
            $table->string('personal_top_flavor_2');
            $table->string('personal_top_flavor_3');
            $table->string('recommendation_1_id');
            $table->string('recommendation_1_title');
            $table->integer('recommendation_1_compatibillity');
            $table->string('recommendation_2_id');
            $table->string('recommendation_2_title');
            $table->integer('recommendation_2_compatibility');
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
        Schema::dropIfExists('master_items');
    }
}
