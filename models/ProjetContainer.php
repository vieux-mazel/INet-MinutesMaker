<?php namespace VM\MinuteMaker\Models;

use Model;

/**
 * projet_container Model
 */
class ProjetContainer extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vm_minutemaker_projet_containers';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'projet' => ['VM\MinuteMaker\Models\Projet']
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'categories' => [
            'VM\MinuteMaker\Models\StructureCategory',
            'table' => 'vm_minutemaker_cat_projet'
            'key'      => 'projet_id',
            'otherKey' => 'category_id']
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}
