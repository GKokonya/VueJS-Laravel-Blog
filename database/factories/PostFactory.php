<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Post;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model =Post::class;

    public function definition()
    {
        return [
            //
            'title'=>fake()->realText(rand(10, 20)),
            'content'=>fake()->text(),
            'user_id'=>1,
            'category_id'=>1,
            'image'=>'images/nN60YENYXjTZF69XQJqyjHIa78Y29zZqKw9XuPCM.jpg',
            'created_at'=>now(),
            'updated_at'=>now()
        ];
    }

    /**
     * Indicate that the model's default image.
     *
     * @return static
     */
    public function default_values()
    {
        return $this->state(fn (array $attributes) => [
            
        ]);
    }
}
