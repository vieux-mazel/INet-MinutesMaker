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
        'categories' => ['VM\MinuteMaker\Models\StructureCategory'] //relation witrh StructureCategory
    ];
    public $belongsTo = [];

    public $belongsToMany = [
        'show' => ['ShahiemSeymor\Roles\Models\Groupe', 'table' => 'vm_minutemaker_structures_groups_show']
    ];

    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}
