<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('promo_code')->unique();
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->tinyInteger('available_until')->default(1);
            $table->double('discount_amount')->default(0);
            $table->tinyInteger('number_of_use')->default(1);
            $table->double('min_amount')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('coupons');
    }
}
