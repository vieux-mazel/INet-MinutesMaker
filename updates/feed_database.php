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
        $sm = Structure::create([
            'name' => 'Séance de maîtrise',
            'description' => 'Toutes les séances de la maîtrise',
            ]);
        $red = Category::create([
            'name' => 'Rouges',
            'description' => 'Les séances des Rouges',
            ]);
        $orange = Category::create([
            'name' => 'Ru\'nion',
            'description' => 'Les séances des Oranges',
            ]);
        $b1 = Category::create([
            'name' => 'Branche Louveteaux et Louvettes',
            'description' => 'Les séances de la branche Louveteaux et Louvettes',
            ]);
        $b2 = Category::create([
            'name' => 'Branche éclaireuses et éclaireur',
            'description' => 'Les séances de la Branche éclaireuses et éclaireur',
            ]);
        $b3 = Category::create([
            'name' => 'PiCos',
            'description' => 'Les séances de maîtrise PiCos',
            ]);


        $sm->categories()->attach($red);
        $sm->categories()->attach($orange);
        $sm->categories()->attach($b1);
        $sm->categories()->attach($b2);
        $sm->categories()->attach($b3);
    }

}
