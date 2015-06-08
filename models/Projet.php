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

    protected $dates = array('start','end');
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
        'seances' => ['VM\MinuteMaker\Models\Seance', 'order' => 'date desc']
    ];
    public $belongsTo = [
        'container' => ['VM\MinuteMaker\Models\ProjetContainer', 'key' => 'container_id'],
        'leader' => ['RainLab\User\Models\User'],
        'category' => ['VM\MinuteMaker\Models\StructureCategory', 'key' => 'category_id']

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
    public function getParent(){ //return a container or category
        return true;
    }
    public function getParentLink(){ //return parent container/category complete URL
        return true;
    }
    public function getNotifyEmails(){ //return an array with all email to notify
        // if leader and team not set get parent catgory/container notifiable user
        // Add parent admin to notfy list (Rouges de la branche + Violet ?)
        return true;
    }


}
