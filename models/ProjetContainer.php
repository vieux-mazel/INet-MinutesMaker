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
    public $hasMany = [
        'projets' => ['VM\MinuteMaker\Models\Projet', 'key' => 'container_id'],
        'seances' => ['VM\MinuteMaker\Models\Seance']
    ];
    public $belongsToMany = [];
    public $belongsTo = [
        'ns' => ['VM\MinuteMaker\Models\Structure'],
        'category' => ['VM\MinuteMaker\Models\StructureCategory', 'key' => 'category_id'],
        #'active_projet' => ['VM\MinuteMaker\Models\Projet'],
    ];
}
