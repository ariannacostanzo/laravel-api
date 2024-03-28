<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            ['label' => 'HTML', 'color' => '#dc3545'],
            ['label' => 'CSS', 'color' => '#0d6efd'],
            ['label' => 'ES6', 'color' => '#ffc107'],
            ['label' => 'Bootstraap', 'color' => '#212529'],
            ['label' => 'Vue', 'color' => '#198754'],
            ['label' => 'SQL', 'color' => '#6c757d'],
            ['label' => 'php', 'color' => '#0dcaf0'],
            ['label' => 'Laravel', 'color' => '#4f1117'],
        ];

        foreach($technologies as $tech)
        {
            $new_tech = new Technology();

            $new_tech->label = $tech['label'];
            $new_tech->color = $tech['color'];

            $new_tech->save();
        }
    }
}
