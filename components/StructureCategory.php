<?php namespace VM\MinuteMaker\Components;

use Cms\Classes\ComponentBase;
use VM\MinuteMaker\Models\Structure as NS;
use VM\MinuteMaker\Models\StructureCategory as Cat;
use VM\MinuteMaker\Models\ProjetContainer as ProjetContainer;
use VM\MinuteMaker\Models\Projet as Projet;
use VM\MinuteMaker\Models\Seance as Seance;
use Input;
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
    public $seance_id = null;

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
        $this->loadJsAndCss();
    }
    public function loadJsAndCss(){
        $this->addJs('/plugins/vm/minutemaker/components/inc/js/datepicker.js');
        $this->addJs('/plugins/vm/minutemaker/components/inc/js/tinymce/tinymce.min.js');
        $this->addJs('/plugins/vm/minutemaker/components/inc/js/register_tinymce.js');
        $this->addCss('/plugins/vm/minutemaker/components/inc/css/datepicker.css');
        $this->addCss('/plugins/vm/minutemaker/components/inc/css/default.css');
    }

    public function prepareVars(){
        $this->seance_id = Input::get('seance_id');
        $this->seance = Seance::whereSlug($this->seance_id)->first();
        $this->header_message = $this->page['header_message'] = Seance::whereSlug($this->seance_id);

        $this->nsslug = $this->page['nsslug'] = $this->property('nsslug');
        $this->catslug = $this->page['catslug'] = $this->property('catslug');
        $this->ns = $this->page['ns']= NS::whereSlug($this->nsslug)->first();
        $this->cat = $this->page['cat'] = Cat::whereSlug($this->catslug)->where('structure_id',$this->ns->id)->first();

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
        $this->current_sh_projet = $this->page['semestre'] = $this->cat->createOrGetActiveSemestre($this->gap); //get current Semestre (Projet) - Contient les séances


    }


    /**
     * -------------------
     * AJAX Action Handler
     * -------------------
     */
     public function onPreviousSemestre(){
         $this->gap = post('gap')-1;
         $this->prepareVars();
     }
     public function onNextSemestre(){
         $this->gap = post('gap')+1;
         $this->prepareVars();
     }
     public function updateDefault()
     {
         $this->prepareVars();
         return ['#semester_header' => $this->renderPartial('::semesterheader')];

         #$this->prepareVars();
         // $this->current_sh_projet = $this->cat->createOrGetActiveSemestre($this->gap);
         #return $this->renderPartial('::default');
         #return $this->renderPartial('::default');
         #    public function updateDefault()
     }
     public function onAddSeance(){
         $seance_dates = explode(',', post('date'));
         $this->gap = post('gap');
         $cat_id = post('cat_id');
         $cat = Cat::find($cat_id);
         foreach ($seance_dates as $seance_date) {
             $seance = New Seance;
             if(is_null($cat->semestre_handler)){
                 $seance->category = $cat;
             } else{
                 $seance->projet = $cat->createOrGetActiveSemestre($this->gap);
             }
             $format = 'd/m/Y';
             $date = \DateTime::createFromFormat($format,$seance_date);
             $seance->date = $date;
             $seance->name = 'Séance du ' . $date->format('d/m/Y');
             $seance->save();
         }
         $this->prepareVars();

     }
     public function onAddProjetHandler(){
         $this->gap = post('gap');
         $cat_id = post('cat_id');
         $cat = Cat::find($cat_id);

         $handler = new ProjetContainer;
         $handler->name = post('name');
         $handler->description = post('description');
         $handler->category_handled = $cat;
         $handler->save();
         $this->cat = $this->page['cat'] = Cat::find($cat_id);
         $this->prepareVars();

     }
     public function onAddProjet(){
         $this->gap = post('gap');
         $cat_id = post('cat_id');
         $cat = Cat::find($cat_id);

         $projet = new Projet;
         $projet->description = post('description');
         $projet->name = post('name');
         $seance_dates = explode(',', post('date')); //handle multi date form not used here
         $format = 'd/m/Y';
         $date = \DateTime::createFromFormat($format,$seance_date);
         $projet_handled = 0;
         // check if projet handler is checked and assign projet to handler (ProjetContainer)
     }

}
