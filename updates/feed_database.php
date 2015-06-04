<?php namespace RainLab\Forum\Updates;

use Schema;
use VM\MinuteMaker\Models\Link as Ln;
use VM\MinuteMaker\Models\Point as Pt;
use VM\MinuteMaker\Models\Projet as Project;
use VM\MinuteMaker\Models\ProjetContainer as Container;
use VM\MinuteMaker\Models\Seance as Seance;
use VM\MinuteMaker\Models\Structure as Structure;
use VM\MinuteMaker\Models\StructureCategory as Category;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{

    public function run()
    {
        $ns_sm = Structure::create([
            'name' => 'Maîtrise',
            'description' => 'Toutes les séances de la maîtrise',
            'slug' => 'maitrise',
            ]);

            $b1 = Category::create([
                'name' => 'Louvettes & Louveteaux',
                'description' => 'Les séances et projets de la première branche',
                'slug' => 'loups',
                'structure' => $ns_sm,
                ]);
            $b2 = Category::create([
                'name' => 'Éclaireuses et éclaireurs',
                'description' => 'Les séances de la Branche éclaireuses et éclaireur',
                'slug' => 'eclais',
                'structure' => $ns_sm,
                ]);
            $b3 = Category::create([
                'name' => 'PiCos',
                'description' => 'Les séances de maîtrise PiCos',
                'slug' => 'picos',
                'structure' => $ns_sm,
                ]);
            $orange = Category::create([
                'name' => 'RU',
                'description' => 'Les séances des Oranges',
                'slug' => 'ru',
                'structure' => $ns_sm,
                ]);
            $rouge = Category::create([
                'name' => 'Rouges',
                'description' => 'Les séances des rouges',
                'slug' => 'rouge',
                'structure' => $ns_sm,
                ]);
            $rouge = Category::create([
                'name' => 'Brigade',
                'description' => 'Les séances et porjets de la brigade',
                'slug' => 'brigade',
                'structure' => $ns_sm,
                ]);

        $ns_tot = Structure::create([
            'name' => 'Totémisés',
            'description' => 'Toutes les projets et documents des totémisés',
            'slug' => 'totemisation',
            ]);

        $ns_picos = Structure::create([
            'name' => 'Picos',
            'description' => 'Toutes les projets et documents des totémisés',
            'slug' => 'picos'
            ]);
    }

}
