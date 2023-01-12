<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['name_ar' => 'جديد', 'name_en' => 'new'],
            ['name_ar' => 'جاري التحضير', 'name_en' => 'on grill'],
            ['name_ar' => 'جاري التوصيل', 'name_en' => 'Delivery is in progress'],
            ['name_ar' => 'تم الاستلام', 'name_en' => 'delivered successfully'],
            ['name_ar' => 'ملغى', 'name_en' => 'canceled'],
            ['name_ar' => 'معلق', 'name_en' => 'pending'],
        ];

        OrderStatus::insert($status);


    }
}
