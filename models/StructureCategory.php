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
    public $hasOne = [
        'semestre_handler' => ['VM\MinuteMaker\Models\ProjetContainer'],
        'projet_handler' => ['VM\MinuteMaker\Models\ProjetContainer'] // Used for longtime project
    ];

    public $hasMany = [
        //'seances' => ['VM\MinuteMaker\Models\Seance'], //relation with Seance
        'projets' => ['VM\MinuteMaker\Models\Projet'],
        'commissions' => ['VM\MinuteMaker\Models\Projet']
    ];
    public $belongsTo = [
        'structure' => ['VM\MinuteMaker\Models\Structure'] //relation with StructureCategory~Structure => structure_id in db
    ];

    public $belongsToMany = [

        'notify' => ['RainLab\User\Models\Group',
            'table' => 'vm_minutemaker_cat_notify',
            'key'      => 'category_id',
            'otherKey' => 'group_id'], //relation witrh StructureCategory~Structure => structure_id in db

        'watchers' => ['RainLab\User\Models\User', // Create independant object with polymporph relation
            'table' => 'vm_minutemaker_cat_watcher',
            'key'      => 'category_id',
            'otherKey' => 'user_id'], //relation witrh StructureCategory~Structure => structure_id in db
    ];
    // TODO:
    //   - Can_see (hasMany users)
    //   - Manager (hasMany users)
    //   - Notify (hasMany users)

}
