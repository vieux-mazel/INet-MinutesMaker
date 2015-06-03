<?php namespace VM\MinuteMaker;

use System\Classes\PluginBase;

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
            'MinuteMaker' => [
                'label' => 'MinuteMaker',
                'url' => Backend::url('vm/minute/structure'),
                'icon' => 'icon-leaf',
                #'permissions' => ['rainlab.users.*'],
                'order' => 500,

                'sideMenu' => [
                    'structure' => [
                        'label' => 'Structure',
                        'icon' => 'icon-ticket',
                        'url' => Backend::url('vm/minute/structure'),
                        #'permissions' => ['rainlab.users.access_users']
                    ],
                    'structurecategory' => [
                        'label' => 'Catégories',
                        'icon' => 'icon-th',
                        'url' => Backend::url('vm/minute/categories'),
                        #'permissions' => ['rainlab.users.access_users']
                    ]
                ]
            ]
        ];
   }

    //extend Group models to have hasMany Structure and Structure_Category
    //public $belongsToMany = [
    //    'posts' => ['Acme\Blog\Models\Post', 'table' => 'acme_blog_posts_categories']
    //];

}
