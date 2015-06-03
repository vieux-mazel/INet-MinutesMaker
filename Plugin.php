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

    //extend Group models to have hasMany Structure and Structure_Category
    //public $belongsToMany = [
    //    'posts' => ['Acme\Blog\Models\Post', 'table' => 'acme_blog_posts_categories']
    //];

}
