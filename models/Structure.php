<?php namespace VM\MinuteMaker\Models;

use Model;
use VM\MinuteMaker\Models\Structure as Struct;
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

    public $belongsToMany = [
        'show' => ['ShahiemSeymor\Roles\Models\Group',
            'table' => 'vm_minutemaker_struct_perms',
            'key' => 'structure_id',
            'otherKey' => 'group_id']
    ];

    public $hasMany = [
        'categories' => ['VM\MinuteMaker\Models\StructureCategory'],
        'projets_containers' => ['VM\MinuteMaker\Models\ProjetContainer', 'key' => 'ns_id'],
        #'projets' => ['VM\MinuteMaker\Models\Projet', 'key' => 'structure_id'], 
    ];

    public function getCat(){
        return $this->categories;
    }


}
