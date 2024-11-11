<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('condition');
            $table->integer('usage_duration');
            $table->string('image');
            $table->string('status');


            $table->boolean('is_exchange_specific')->default(false);
            $table->unsignedBigInteger('desired_item_id')->nullable();
            $table->string('desired_item_category')->nullable();
            $table->string('desired_item_subcategory')->nullable();
            $table->text('desired_item_description')->nullable();
            $table->boolean('show')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('theusers');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
