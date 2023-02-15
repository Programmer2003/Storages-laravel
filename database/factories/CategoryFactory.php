<?php

namespace Database\Factories;

use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $storage_id = Storage::get()->random()->id;
        $data =  [
            'name' => $this->faker->word(2),
            'storage_id' => $storage_id,
        ];

        if (Schema::hasColumn('categories', 'retail') && $storage_id==1) {
            $data['retail'] = $this->faker->random_int(1,10);
        }
        
        return $data;
    }
}
