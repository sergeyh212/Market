<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'iPhone X 64GB',
                'code' => 'iphone_x_64',
                'category_id' => 'Отличный продвинутый телефон с памятью на 64 gb',
                'image' => '71990',
                'description' => 1,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'iPhone X 256GB',
                'code' => 'iphone_x_256',
                'category_id' => 'Отличный продвинутый телефон с памятью на 256 gb',
                'image' => '89990',
                'description' => 1,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'HTC One S',
                'code' => 'htc_one_s',
                'category_id' => 'Зачем платить за лишнее? Легендарный HTC One S',
                'image' => '12490',
                'description' => 1,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'iPhone 5SE',
                'code' => 'iphone_5se',
                'category_id' => 'Отличный классический iPhone',
                'image' => '17221',
                'description' => 1,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'Наушники Beats Audio',
                'code' => 'beats_audio',
                'category_id' => 'Отличный звук от Dr. Dre',
                'image' => '20221',
                'description' => 2,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'Камера GoPro',
                'code' => 'gopro',
                'category_id' => 'Снимай самые яркие моменты с помощью этой камеры',
                'image' => '12000',
                'description' => 2,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'Камера Panasonic HC-V770',
                'code' => 'panasonic_hc-v770',
                'category_id' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
                'image' => '27900',
                'description' => 2,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'Кофемашина DeLongi',
                'code' => 'delongi',
                'category_id' => 'Хорошее утро начинается с хорошего кофе!',
                'image' => '25200',
                'description' => 3,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'Холодильник Haier',
                'code' => 'haier',
                'category_id' => 'Для большой семьи большой холодильник!',
                'image' => '40200',
                'description' => 3,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'Блендер Moulinex',
                'code' => 'moulinex',
                'category_id' => 'Для самых смелых идей',
                'image' => '4200',
                'description' => 3,
                'price' => '',
                'count' => rand(1, 10)
            ],
            [
                'name' => 'Мясорубка Bosch',
                'code' => 'bosch',
                'category_id' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'image' => '9200',
                'description' => 3,
                'price' => '',
                'count' => rand(1, 10)
            ],
        ]);
    }
}