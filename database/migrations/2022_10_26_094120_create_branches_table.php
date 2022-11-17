<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('address');
            $table->string('image')->nullable();
            $table->string('range_of_delivery_price')->default('from:5 to:15');
            $table->string('latitude');
            $table->string('longitude');
            $table->tinyInteger('reviews')->default(2);
            $table->boolean('active')->default(1);
            $table->boolean('is_open')->default(1);
            $table->boolean('schedule')->default(0);
            $table->string('phone')->nullable();
            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('branches');
    }
}
