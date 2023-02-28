<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Closure;
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
                    'name' => 'Белкоопсоюз Склад N1',
                    'address' => 'Победилетей 17',
                    'type' => 'Продовольственные товары',
                    'img' => '1.png',
                ],
                [
                    'name' => 'Белкоопсоюз Склад N2',
                    'address' => '',
                    'type' => 'Промышленные товары',
                    'img' => '2.png',
                ],
            ];

        foreach ($storages as $storage) {
            Storage::create($storage);
        }

        $categories =
            [
                [
                    'storage_id' => '1',
                    'name' => 'Молочные продукты',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Молоко',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Коровье молоко',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Сгущенное, сухое молоко',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Кефир, кисломолчные изделия',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Кефир, бифидопродукты',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Закваски',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Мясные продукты',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Свининна',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Разделка охлажденная из свинины',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Копчености из свинины',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Полуфабрикаты',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Колбаски, купаты',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Фарши',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Шашлыки',
                ],
                [
                    'storage_id' => '1',
                    'name' => 'Котлетки, биточки и прочие п/ф',
                ],
                [
                    'storage_id' => '2',
                    'name' => 'Электроника и комплектующие для авто',
                ],
                [
                    'storage_id' => '2',
                    'name' => 'Автоэлектроника',
                ],
                [
                    'storage_id' => '2',
                    'name' => 'Видеорегистраторы',
                ],
                [
                    'storage_id' => '2',
                    'name' => 'Навигаторы',
                ],
                [
                    'storage_id' => '2',
                    'name' => 'Алкотестеры',
                ],
            ];

        foreach ($categories as $category) {
            Category::create($category);
        }


        $closures = [
            [
                'ancestor' => '1',
                'descendant' => '2',
            ],
            [
                'ancestor' => '2',
                'descendant' => '3',
            ],
            [
                'ancestor' => '2',
                'descendant' => '4',
            ],
            [
                'ancestor' => '1',
                'descendant' => '5',
            ],
            [
                'ancestor' => '5',
                'descendant' => '6',
            ],
            [
                'ancestor' => '5',
                'descendant' => '7',
            ],
            [
                'ancestor' => '8',
                'descendant' => '9',
            ],
            [
                'ancestor' => '9',
                'descendant' => '10',
            ],
            [
                'ancestor' => '9',
                'descendant' => '11',
            ],
            [
                'ancestor' => '8',
                'descendant' => '12',
            ],
            [
                'ancestor' => '12',
                'descendant' => '13',
            ],
            [
                'ancestor' => '12',
                'descendant' => '14',
            ],
            [
                'ancestor' => '12',
                'descendant' => '15',
            ],
            [
                'ancestor' => '12',
                'descendant' => '16',
            ],
            [
                'ancestor' => '17',
                'descendant' => '18',
            ],
            [
                'ancestor' => '18',
                'descendant' => '19',
            ],
            [
                'ancestor' => '18',
                'descendant' => '20',
            ],
            [
                'ancestor' => '18',
                'descendant' => '21',
            ],
        ];

        foreach ($closures as $closure) {
            Closure::create($closure);
        }

        $products =
            [
                [
                    'name' => 'Молоко стерилизованное 3.2%',
                    'category_id' => '3'
                ],
                [
                    'name' => 'Молоко стерилизованное 2.8%',
                    'category_id' => '3'
                ],
                [
                    'name' => 'Закваска «Vita» сухая, для йогурта с бифидобактериями',
                    'category_id' => '7'
                ],
                [
                    'name' => 'Купаты из мяса птицы «Дачные» замороженные',
                    'category_id' => '13'
                ],
                [
                    'name' => 'Колбаски сырые «Домашние» охлажденные',
                    'category_id' => '13'
                ],
                [
                    'name' => 'Набор полуфабрикатов «Ассорти для барбекю»',
                    'category_id' => '13'
                ],
                [
                    'name' => 'Колбаски «Полесские» охлажденные',
                    'category_id' => '13'
                ],
                [
                    'name' => 'Шашлык «Из филе птицы» охлажденный',
                    'category_id' => '15'
                ],
                [
                    'name' => 'Шашлык «Из птицы в майонезе» трумф',
                    'category_id' => '15'
                ],
                [
                    'name' => 'Фарш свиной «Новый» охлажденный',
                    'category_id' => '14'
                ],
            ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
