<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works_times', function (Blueprint $table) {
            $table->id();
            $table->time('from');
            $table->time('to');
            $table->string('notes_ar')->nullable();
            $table->string('notes_en')->nullable();
            $table->foreignId('vendor_id')->constrained();
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
        Schema::dropIfExists('works_times');
    }
}
