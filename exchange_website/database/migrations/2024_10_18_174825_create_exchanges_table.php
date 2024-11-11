<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('offered_item_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('theusers');
            $table->foreign('receiver_id')->references('id')->on('theusers');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('offered_item_id')->references('id')->on('items');
        });
    }

    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
