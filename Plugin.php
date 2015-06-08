<?php namespace VM\MinuteMaker;

use System\Classes\PluginBase;
use Backend;
/**
 * MinuteMaker Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'MinuteMaker',
            'description' => 'No description provided yet...',
            'author'      => 'VM',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerNavigation()
    {
        return [
            'minutemaker' => [
                'label' => 'MinuteMaker',
                'url' => Backend::url('vm/minutemaker/structure'),
                'icon' => 'icon-leaf',
                #'permissions' => ['rainlab.users.*'],
                'order' => 500,

                'sideMenu' => [
                    'structure' => [
                        'label' => 'Structure',
                        'icon' => 'icon-ticket',
                        'url' => Backend::url('vm/minutemaker/structure'),
                        #'permissions' => ['rainlab.users.access_users']
                    ],
                    'structurecategory' => [
                        'label' => 'Catégories',
                        'icon' => 'icon-th',
                        'url' => Backend::url('vm/minutemaker/structurecategory'),
                        #'permissions' => ['rainlab.users.access_users']
                    ]
                ]
            ]
        ];
   }

   public function registerMarkupTags()
    {
        return [
            'functions' => [
                // Using an inline closure
                'today' => function() { return new \DateTime(); }
            ]
        ];
    }
   public function registerComponents()
   {
       return[
           'VM\MinuteMaker\Components\DiscussionTracking' => 'BlablaTrack',
           'VM\MinuteMaker\Components\Projet' => 'projet',
           'VM\MinuteMaker\Components\ProjetContainer' => 'projetContainer',
           'VM\MinuteMaker\Components\Seance' => 'seance',
           'VM\MinuteMaker\Components\StructureCategory' => 'StructureCategory',
           'VM\MinuteMaker\Components\StructureNamespace' => 'ns',
           'VM\MinuteMaker\Components\Structure' => 'Structure',

       ];
   }

    //extend Group models to have hasMany Structure and Structure_Category
    //public $belongsToMany = [
    //    'posts' => ['Acme\Blog\Models\Post', 'table' => 'acme_blog_posts_categories']
    //];

}
