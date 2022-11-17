<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_number');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('delivery_type_id')->constrained();
            $table->foreignId('order_status_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->string('firebase_id');
            $table->boolean('payment_status')->default(0);
            $table->double('coupon_discounts');
            $table->double('total_before_discount_and_tax');
            $table->double('total_after_discount_and_tax');
            $table->dateTime('delivered_at');
            $table->time('delivery_time');
            $table->date('delivery_date');
            $table->enum('cancelled_by',['store','user']);
            $table->tinyInteger('discount')->default(0);
            $table->string('discount_reason');
            $table->tinyInteger('tax')->default(0);
            $table->tinyInteger('reviews');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
