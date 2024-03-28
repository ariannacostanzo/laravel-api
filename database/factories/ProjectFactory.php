<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::makeDirectory('project_images');
        $title = fake()->text(30);
        $slug = Str::slug($title);
        //la funzione non sta funzionando
        $img = fake()->image(null, 200, 200);
 
        $img_url = Storage::putFileAs('project_images', $img , "$slug.png"); 

        $type_ids = Type::pluck('id')->toArray();
        $type_ids[] = null;

        return [
            'title' => $title,
            'type_id' => Arr::random($type_ids),
            'slug' => $slug,
            'description' => fake()->paragraphs(8, true),
            'image' => $img_url,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Project $project) {
            $tech_ids = Technology::pluck('id')->toArray();
            $project_technologies = array_filter($tech_ids, fn() => rand (0, 1));

            $project->technologies()->attach($project_technologies);
        });
    }
}
