<?php namespace VM\MinuteMaker\Components;

use Cms\Classes\ComponentBase;
use VM\MinuteMaker\Models\Structure as NS;
use Cms\Classes\Page;
class StructureNamespace extends ComponentBase
{

    /**
     * --------
     *   VARS
     * --------
     *
     *
     * Container for slugged VM\MinuteMaker\Structure named "Namespace"
     * @var VM\MinuteMaker\Structure
     */
    public $ns;
    public $catpage;

    public function componentDetails()
    {
        return [
            'name'        => 'Namespace Component',
            'description' => 'Liste les catégories d\'un NS',
        ];
    }

    public function defineProperties()
    {
        return [
            'nsslug' => [
                'title'       => 'Slug',
                'description' => 'Slug représentant la structure',
                'default'     => '{{ :nsslug }}',
                'type'        => 'string',
            ],
        ];
    }

    public function getPropertyOptions($property)
    {
        return Page::sortBy('url')->lists('url', 'url');
    }

    public function onRun(){
        $this->ns = $this->getStructure();
        $this->prepareVars();
    }
    public function prepareVars(){
        $this->catpage = $this->page['catpage'] = strstr($this->property('structurecategory'), ':', true);
    }

    public function getStructure(){
        if ($this->ns !== null)
            return $this->ns;
        if (!$slug = $this->property('nsslug'))
            return null;
        return NS::whereSlug($slug)->first();
    }




}
