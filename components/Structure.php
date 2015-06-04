<?php namespace VM\MinuteMaker\Components;

use Cms\Classes\ComponentBase;
use VM\MinuteMaker\Models\Structure as NS;
use Cms\Classes\Page;

class Structure extends ComponentBase
{
    public $nss;
    public $nspage;
    public function componentDetails()
    {
        return [
            'name'        => 'Structure',
            'description' => 'Liste toutes les structures'
        ];
    }

    public function defineProperties()
    {
        return [
            'structurens' => [
                'title'       => 'Namespace slug page',
                'description' => 'Page qui affiche toutes les catégories d\'un NS',
                'type'        => 'dropdown',
            ]
        ];
    }

    public function getPropertyOptions($property)
    {
        return Page::sortBy('url')->lists('url', 'url');
    }

    public function onRun(){
        $this->nss = NS::all();
        $this->nspage = $this->page['nspage'] = strstr($this->property('structurens'), ':', true);
    }



}
