<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->unique();
            $table->string('name_en')->unique();
            $table->string('email');
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->boolean('active')->default(1);
            $table->string('tax')->default(0);
            $table->foreignId('category_id')->constrained();
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
        Schema::dropIfExists('vendors');
    }
}
