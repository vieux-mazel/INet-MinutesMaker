<?php namespace VM\MinuteMaker\Models;

use Model;

/**
 * projet Model
 */
class Projet extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vm_minutemaker_projets';

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
        'seance' => ['VM\MinuteMaker\Models\Seance']
    ];
    public $belongsTo = [
        'container' => ['VM\MinuteMaker\Models\ProjetContainer'],
        'leader' => ['RainLab\User\Models\User'],
        'category' => ['VM\MinuteMaker\Models\StructureCategory']

    ];
    public $belongsToMany = [
        'member' => ['RainLab\User\Models\User', //relation witrh StructureCategory~Structure => structure_id in db
            'table' => 'vm_minutemaker_projet_member',
            'key'      => 'projet_id',
            'otherKey' => 'user_id'],

        'bilan' => ['VM\MinuteMaker\Models\Point', // link to bilan
            'table' => 'vm_minutemaker_projet_bilan',
            'key'      => 'projet_id',
            'otherKey' => 'point_id'],
    ];
    public function notifyUsers(){
        //Notify member + leader + Category Watchers
        return true;
    }



}
