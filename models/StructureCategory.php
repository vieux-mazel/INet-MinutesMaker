<?php namespace VM\MinuteMaker\Models;

use Model;

/**
 * structure_category Model
 */
class StructureCategory extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Auto generated slug
     */
    protected $slugs = ['slug' => 'title'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vm_minutemaker_structure_categories';

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
        'seances' => ['VM\MinuteMaker\Models\StructureCategory'] //relation with Seance
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'projets' => [
            'VM\MinuteMaker\Models\ProjetContainer',
            'table' => 'vm_minutemaker_cat_projet',
            'key'      => 'category_id',
            'otherKey' => 'projet_id'],
        'structure' => ['VM\MinuteMaker\Models\Structure',
            'table' => 'vm_minutemaker_struct_cat',
            'key'      => 'category_id',
            'otherKey' => 'structure_id'], //relation witrh StructureCategory~Structure => structure_id in db
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}
