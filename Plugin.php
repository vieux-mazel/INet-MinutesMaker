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

    //extend Group models to have hasMany Structure and Structure_Category
    //public $belongsToMany = [
    //    'posts' => ['Acme\Blog\Models\Post', 'table' => 'acme_blog_posts_categories']
    //];

}
