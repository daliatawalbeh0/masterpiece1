<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();  // معرف الإدمن
            $table->string('name');  // اسم الإدمن
            $table->string('email')->unique();  // بريد إلكتروني فريد للإدمن
            $table->string('password');  // كلمة مرور الإدمن
            $table->unsignedBigInteger('role_id');  // علاقة مع جدول roles
            $table->timestamps();  // توقيتات الإنشاء والتعديل

            // علاقة مع جدول roles
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
