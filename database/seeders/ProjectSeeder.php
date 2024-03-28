<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Spotify',
                'slug' => 'spotify',
                'description' => 'Questo sito si propone come un\'imitazione del famoso Spotify.',
                'image' => '',
            ],
            [
                'title' => 'Giallo Booleano',
                'slug' => 'giallo-booleano',
                'description' => 'Questo sito si propone come un\'imitazione del famoso Giallo Zafferano.',
                'image' => '',
            ],
            [
                'title' => 'Boolflix',
                'slug' => 'boolflix',
                'description' => 'Questo sito si propone come un\'imitazione del famoso Netflix.',
                'image' => '',
            ],
            [
                'title' => 'Boolzap',
                'slug' => 'boolzap',
                'description' => 'Questo sito si propone come un\'imitazione del famoso WhatsApp.',
                'image' => '',
            ],
            [
                'title' => 'Boolando',
                'slug' => 'boolando',
                'description' => 'Questo sito si propone come un\'imitazione del famoso Zalando.',
                'image' => '',
            ],
            [
                'title' => 'DC Comics',
                'slug' => 'dc-comics',
                'description' => 'Questo sito si propone come un\'imitazione del famoso DC Comics.',
                'image' => '',
            ],
        ];

        foreach ($projects as $project) {
            

            $new_project = new Project();
            $new_project->fill($project);
            // $new_project->image = Storage::putFileAs('project_images', $project['image']); 
            
            $new_project->save();
        }
    }
}
