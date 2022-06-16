<?php

namespace Aamin\Category\Database\Factories;

use Aamin\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Category::class;

    public function definition()
    {
        $category_id = Category::pluck('id')->toArray();
        $categories = [
            'وسایل خانگی',
            'تجهیزات برقی',
            'مبلمان',
            'ظروف آشپزخانه',
            'یخچال',
            'تلویزیون',
            'تلفن همراه',
            'لپ تاپ',
            'سرویس خواب',
            'وسایل بهداشتی',
            'وسایل خانگی',
        ];
        return [
            'name' => $this->faker->randomElement($categories),
            'category_id' => $this->faker->randomElement($category_id)
        ];
    }
}
