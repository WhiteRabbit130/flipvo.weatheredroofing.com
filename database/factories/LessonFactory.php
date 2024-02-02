<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition(): array
    {
        return [
            'teacher_id' => $this->faker->numberBetween(1, 100),
            'student_id' => $this->faker->numberBetween(1, 100),
            'instrument_id' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 0, 100),


//        'date' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
//        'start_time' => $this->faker->time(),
//        'end_time' => $this->faker->time(),
//        'duration' => $this->faker->numberBetween(30, 120),
//        'rate' => $this->faker->randomFloat(2, 0, 100),
//        'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
//        'notes' => $this->faker->text(),

        ];
    }
}
