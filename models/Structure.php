<?php namespace VM\MinuteMaker\Models;

use Model;

/**
 * structure Model
 */
class Structure extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Auto generated slug
     */
    protected $slugs = ['slug' => 'title'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vm_minutemaker_structures';

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

    ];
    public $belongsTo = [];

    public $belongsToMany = [
        'show' => ['ShahiemSeymor\Roles\Models\Group', 'table' => 'vm_minutemaker_struct_perms'],
        
        'categories' => ['VM\MinuteMaker\Models\StructureCategory',
            'table' => 'vm_minutemaker_struct_cat',
            'key'      => 'structure_id',
            'otherKey' => 'category_id'] //relation witrh StructureCategory
    ];

    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}
