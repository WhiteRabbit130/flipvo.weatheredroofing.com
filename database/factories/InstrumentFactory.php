<?php

namespace Database\Factories;

use App\Models\Instrument;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstrumentFactory extends Factory
{
	protected $model = Instrument::class;

	public function definition(): array
	{
		return [
            // Random: Guitar, Piano, etc.
            'name' => $this->faker->randomElement(['Guitar', 'Piano', 'Drums', 'Bass', 'Violin', 'Cello', 'Trumpet', 'Saxophone', 'Clarinet', 'Flute', 'Trombone', 'French Horn', 'Tuba', 'Oboe', 'Bassoon', 'Viola', 'Ukulele', 'Banjo', 'Mandolin', 'Harp', 'Accordion', 'Bagpipes', 'Organ', 'Harmonica', 'Recorder', 'Xylophone', 'Marimba', 'Steel Drums', 'Synthesizer', 'Theremin', 'Vocals', 'Other']),
		];
	}
}
