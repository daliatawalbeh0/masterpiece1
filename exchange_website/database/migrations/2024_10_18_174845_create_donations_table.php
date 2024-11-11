<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_id');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('item_title');
            $table->string('status');
            $table->timestamps();

            $table->foreign('donor_id')->references('id')->on('theusers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
