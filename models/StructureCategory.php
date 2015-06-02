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
    public $belongsTo = [
        'structure' => ['VM\MinuteMaker\Models\Structure'] //relation witrh StructureCategory~Structure => structure_id in db
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}
