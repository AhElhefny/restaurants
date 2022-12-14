<?php

use App\Models\DeliveryMan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryMenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_men', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('identity');
            $table->string('driving_license');
            $table->enum('type',['personal','company']);
            $table->enum('account_status',['0','1','2','3'])->default(DeliveryMan::PENDING);
            $table->unsignedBigInteger('delivery_company_id')->nullable();
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
        Schema::dropIfExists('delivery_men');
    }
}
