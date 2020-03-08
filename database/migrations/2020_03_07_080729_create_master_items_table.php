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
            $table->integer('id')->unsigned();
            $table->tinyinteger('q01')->unsigned();
            $table->tinyinteger('q02')->unsigned();
            $table->tinyinteger('q03')->unsigned();
            $table->tinyinteger('q04')->unsigned();
            $table->tinyinteger('q05')->unsigned();
            $table->tinyinteger('q06')->unsigned();
            $table->tinyinteger('q07')->unsigned();
            $table->tinyinteger('q08')->unsigned();
            $table->tinyinteger('q09')->unsigned();
            $table->tinyinteger('q10')->unsigned();
            $table->tinyinteger('q11')->unsigned();
            $table->string('fp_img');
            $table->integer('flavor_id1')->unsigned();
            $table->integer('flavor_id2')->unsigned();
            $table->integer('flavor_id3')->unsigned();
            $table->integer('recommend_item_id1')->unsigned();
            $table->tinyinteger('compatibility1')->unsigned();
            $table->integer('recommend_item_id2')->unsigned();
            $table->tinyinteger('compatibility2')->unsigned();
            $table->timestamps();

            // $table->primary('id');
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
