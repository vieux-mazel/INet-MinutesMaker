<?php namespace VM\MinuteMaker\Components;

use Cms\Classes\ComponentBase;
use VM\MinuteMaker\Models\Structure as NS;
use VM\MinuteMaker\Models\StructureCategory as Cat;
use VM\MinuteMaker\Models\ProjetContainer as ProjetContainer;
use VM\MinuteMaker\Models\Projet as Projet;
use VM\MinuteMaker\Models\Seance as Seance;

class StructureCategory extends ComponentBase
{
    public $ns;
    public $nsslug;
    public $cat;
    public $catslug;
    public $current_sh; // semestre actuel (ProjetContainer)
    public $current_sh_projet; // Semestre actuel (Projet) (contient les séances)
    public $cat_projethandler; // semestre actuel
    public $gap = 0;

    public function componentDetails()
    {
        return [
            'name'        => 'Structure Category',
            'description' => 'Affiche une catégorie',
        ];
    }

    public function defineProperties()
    {
        return [
            'nsslug' => [
                'title'       => 'Namespace Slug',
                'description' => 'Slug représentant la structure ciblée',
                'default'     => '{{ :ns }}',
                'type'        => 'string',
            ],
            'catslug' => [
                'title'       => 'Category Slug',
                'description' => 'Slug représentant la catégorie ciblée',
                'default'     => '{{ :cat }}',
                'type'        => 'string',
            ]
        ];
    }
    public function onRun(){
        $this->prepareVars();
    }

    public function prepareVars(){
        $this->nsslug = $this->page['nsslug'] = $this->property('nsslug');
        $this->catslug = $this->page['catslug'] = $this->property('catslug');
        $this->ns = NS::whereSlug($this->nsslug)->first();
        $this->cat = Cat::whereSlug($this->catslug)->where('structure_id',$this->ns->id)->first();

        if(is_null($this->cat->semestre_handler)){ //create default semester handler
            $this->current_sh = new ProjetContainer();
            $this->current_sh->name = 'Semestres ' . $this->cat->name;
            $this->current_sh->description = 'Tous les semestres des ' . $this->cat->name;
            $this->current_sh->save();

            $this->cat->semestre_handler = $this->current_sh;
            $this->cat->save();
        } else {
            $this->current_sh = $this->cat->semestre_handler; //get current Semestre (ProjetContainer)
        }
        $this->current_sh_projet = $this->cat->createOrGetActiveSemestre($this->gap); //get current Semestre (Projet) - Contient les séances


    }


    /**
     * -------------------
     * AJAX Action Handler
     * -------------------
     */
     public function onPreviousSemestre(){
         $this->gap--;
         #$this->current_sh_projet = $this->page['current_sh_projet'] = $this->cat->createOrGetActiveSemestre($this->gap);
         $this->prepareVars();
         return ['#semester_header' => $this->renderPartial('::semesterheader')];
         // $this->current_sh_projet = $this->cat->createOrGetActiveSemestre($this->gap);
         #return $this->renderPartial('::default');
     }
     public function updateDefault()
     {
         //$this->prepareVars();
         $this->gap = $this->gap - 1;
         $this->prepareVars();
         return ['#semester_header' => $this->renderPartial('::semesterheader')];

         #$this->prepareVars();
         // $this->current_sh_projet = $this->cat->createOrGetActiveSemestre($this->gap);
         #return $this->renderPartial('::default');
         #return $this->renderPartial('::default');
         #    public function updateDefault()
     }

}
