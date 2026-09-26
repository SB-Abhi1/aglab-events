<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory()->count(10)->create();

        Event::create([
            'title'       => 'Seminar on Plant Stress Response Genes',
            'type'        => 'Seminar',
            'event_date'  => now()->addDays(10),
            'event_time'  => '10:00',
            'venue'       => 'BMB Seminar Room, SUST',
            'speaker'     => 'Dr. Ajit Ghosh',
            'description' => 'A seminar discussing recent findings on stress-responsive gene networks in crop and vegetable plant species, presented by the Laboratory of Genomics and Transcriptomics.',
            'status'      => 'Upcoming',
        ]);
    }
}
