<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Faker\Generator;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $labels = ['FrontEnd', 'BackEnd', 'Design', 'Fullstack', 'UI/UX'];
        

        // $types = [
        //     [
        //         'label' => 'FrontEnd',
        //         'description' => 'Il frontend è la parte dell\'applicazione web o software con cui gli utenti interagiscono. Le tecnologie utilizzate nel frontend includono HTML, CSS e JavaScritp.'
        //     ],
        //     [
        //         'label' => 'BackEnd',
        //         'description' => 'Il backend è la parte di un\'applicazione web o software che si occupa della logica di business, dell\'elaborazione dei dati e delle funzionalità non direttamente visibili agli utenti finali. Le tecnologie utilizzate nel backend includono linguaggi di programmazione come PHP, Python, Ruby, C#.'
        //     ],
        //     [
        //         'label' => 'Design',
        //         'description' => 'Il termine "design" si riferisce alla pratica di progettare e sviluppare l\'aspetto visivo e l\'esperienza utente di un\'interfaccia o di un prodotto digitale, come siti web, applicazioni mobili, software e altri strumenti digitali.'
        //     ],
        //     [
        //         'label' => 'Fullstack',
        //         'description' => 'Uno sviluppatore fullstack si occupa sia della parte frontend che della parte backend dello sviluppo di un software'
        //     ],
        //     [
        //         'label' => 'UI/UX',
        //         'description' => 'UI si riferisce alla parte visibile e interattiva di un\'applicazione o di un sito web con cui gli utenti interagiscono direttamente. UX si riferisce all\'esperienza complessiva dell\'utente mentre interagisce con un prodotto o un servizio digitale.'
        //     ],
        // ];

        foreach ($labels as $label) 
        {
            $type = new Type();
            $type->label = $label;
            $type->color = $faker->hexColor();
            $type->save();
        }
    }
}
