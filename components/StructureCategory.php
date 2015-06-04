<?php namespace VM\MinuteMaker\Components;

use Cms\Classes\ComponentBase;

class StructureCategory extends ComponentBase
{

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
            ],
        ];
    }

}
