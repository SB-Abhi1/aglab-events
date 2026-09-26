<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = \App\Models\Event::class;

    public function definition(): array
    {
        $types = ['Seminar', 'Workshop', 'Event', 'Conference', 'Training'];
        $statuses = ['Upcoming', 'Ongoing', 'Completed', 'Cancelled'];

        return [
            'title'       => $this->faker->sentence(6),
            'type'        => $this->faker->randomElement($types),
            'event_date'  => $this->faker->dateTimeBetween('-1 month', '+3 months'),
            'event_time'  => $this->faker->time('H:i'),
            'venue'       => $this->faker->randomElement([
                'BMB Seminar Room', 'AG-Lab Conference Hall', 'SUST Auditorium', 'Online (Zoom)',
            ]),
            'speaker'     => $this->faker->name(),
            'description' => $this->faker->paragraph(4),
            'image'       => null,
            'status'      => $this->faker->randomElement($statuses),
        ];
    }
}
