<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('type',['1','2','3','4','5'])->default(User::USER); // 2 => user
            $table->enum('type_ar', ['مستخدم', 'مدير فرع', 'مسؤول التطبيق','مزود خدمه','المندوب'])->default('مستخدم');
            $table->enum('type_en', ['admin', 'branch manager', 'user','vendor','delivery man'])->default('user');
            $table->string('address')->nullable();
            $table->string('latitude')->default('0');
            $table->string('longitude')->default('0');
            $table->string('phone')->unique()->nullable();
            $table->string('otp')->nullable();
            $table->string('image')->nullable();
            $table->double('wallet_balance')->default(0);
            $table->integer('number_of_successful_order')->default(0);
            $table->boolean('block')->default(0);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
