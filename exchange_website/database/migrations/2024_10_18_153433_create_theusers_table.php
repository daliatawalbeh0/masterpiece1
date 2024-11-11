<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheusersTable extends Migration
{
    public function up()
    {
        Schema::create('theusers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number');
            $table->string('address');
            $table->unsignedBigInteger('role_id');

            $table->timestamps();

            // الربط بجدول roles
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        // حذف جدول theusers عند التراجع عن المهاجرات
        Schema::dropIfExists('theusers');
    }
}
