<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $min = User::min('id');  // 1
        $max = User::max('id');
        return [
            'user_id' => $this->faker->numberBetween($min, $max),	// 2
            'name' => substr($this->faker->word, 0, 20),			// 3
            'description' => $this->faker->sentence,				// 4
            'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),	//5
            'updated_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),			//6
        ];
    }
}
