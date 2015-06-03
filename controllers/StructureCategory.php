<?php namespace VM\MinuteMaker\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Structure Category Back-end Controller
 */
class StructureCategory extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('VM.MinuteMaker', 'minutemaker', 'structurecategory');
    }
}