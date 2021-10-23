<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $min = Project::min('id');
        $max = Project::max('id');

        $date = $this->faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now');
        return [
            'project_id' => $this->faker->numberBetween($min, $max),
            'name' => substr($this->faker->sentence, 0, 20),
            'description' => $this->faker->text,
            'due_date' => $this->faker->dateTimeBetween($startDate = '-1 months', $endDate = '+1 months'),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
