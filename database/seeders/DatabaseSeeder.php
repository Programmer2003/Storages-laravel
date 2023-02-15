<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $storages = 
        [
            [
                'name'=>'Белкоопсоюз Склад N1',
                'address'=>'Победилетей 17',
                'type'=>'Продовольственные товары',
                'img'=>'1.png',
            ],
            [
                'name'=>'Белкоопсоюз Склад N2',
                'address'=>'',
                'type'=>'Промышленные товары',
                'img'=>'2.png',
            ],
        ];

        foreach($storages as $storage){
            Storage::create($storage);
        }

        $categories = 
        [
            [
                'storage_id' => '1',
                'name' => 'Молочные',
                'retail' => 10,
            ],
            [
                'storage_id' => '1',
                'name' => 'Мясные',
                'retail' => 2,
            ],
            [
                'storage_id' => '1',
                'name' => 'Рыбные',
                'retail' => 3,
            ],
            [
                'storage_id' => '1',
                'name' => 'Кондитерские изделия',
                'retail' => 5,
            ],
            [
                'storage_id' => '1',
                'name' => 'Хлебобулочные',
                'retail' => 10,
            ],
            [
                'storage_id' => '2',
                'name' => 'Электрика',
            ],
            [
                'storage_id' => '2',
                'name' => 'Стройматериал',
            ],
            [
                'storage_id' => '2',
                'name' => 'Автотовары',
            ],
            [
                'storage_id' => '2',
                'name' => 'Бытовая техника',
            ],
            [
                'storage_id' => '2',
                'name' => 'Сантехника',
            ],

        ];

        foreach($categories as $category){
            Category::create($category);
        }


        $products =
        [
            [
                'name'=>'Сливки питьевые пастеризованные',
                'price'=>'2.45',
                'category_id' => '1'
            ],
            [
                'name'=>'Говяжьи уши',
                'price'=>'5.99',
                'category_id' => '2'
            ],
            [
                'name'=>'Пельмени',
                'price'=>'3.12',
                'category_id' => '2'
            ],
            [
                'name'=>'Икра лососевая',
                'price'=>'24.99',
                'category_id' => '3'
            ],
            [
                'name'=>'Хлеб тостовый',
                'price'=>'1.89',
                'category_id' => '5'
            ],
            [
                'name'=>'Хлеб "Водар"',
                'price'=>'1.09',
                'category_id' => '5'
            ],
            [
                'name'=>'Кефир',
                'price'=>'0.70',
                'category_id' => '1'
            ],
            [
                'name'=>'Светильник светодиодный',
                'price'=>'29.70',
                'category_id' => '6'
            ],
            [
                'name'=>'Датчик движения',
                'price'=>'45.49',
                'category_id' => '6'
            ],
            [
                'name'=>'Доска обрезная',
                'price'=>'6.05',
                'category_id' => '7'
            ],
            [
                'name'=>'Масло моторное',
                'price'=>'153.20',
                'category_id' => '8'
            ],
            [
                'name'=>'Духовой шкаф',
                'price'=>'1546.01',
                'category_id' => '9'
            ],
            [
                'name'=>'Умывальник Керамин',
                'price'=>'85.28',
                'category_id' => '10'
            ],
            [
                'name'=>'Вытяжка',
                'price'=>'249.00',
                'category_id' => '9'
            ],
        ];

        foreach($products as $product){
            Product::create($product);
        }
        
    }
}
