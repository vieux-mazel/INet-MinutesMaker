<?php namespace VM\MinuteMaker\Models;

use Model;
use VM\MinuteMaker\Models\Projet as Projet;
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
        'semestre_handler' => ['VM\MinuteMaker\Models\ProjetContainer', 'key' => 'category_id'],
        'projet_handler' => ['VM\MinuteMaker\Models\ProjetContainer', 'key' => 'category_id'] // Used for longtime project
    ];

    public $hasMany = [
        //'seances' => ['VM\MinuteMaker\Models\Seance'], //relation with Seance
        'projets' => ['VM\MinuteMaker\Models\Projet', 'key' => 'category_id'],
        'commissions' => ['VM\MinuteMaker\Models\Projet', 'key' => 'category_id']
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
            'otherKey' => 'user_id'] //relation witrh StructureCategory~Structure => structure_id in db
    ];
    public function createOrGetActiveSemestre($gap = 0) {
        $today = new \DateTime();
        $format = 'Y-m-d';
        $i = 1;
        $sign = ($gap<0 ? '-1' : '+1'); //set gap sign
        #$gap = abs($gap);

        while ($i <= abs($gap)) {
            $i++;
            if($today->format("n") >= 8){
                while($today->format('n') >= 8){
                    $today->modify($sign.' month');
                }
            }else{ // n < 9
                while($today->format('n') < 8){
                    $today->modify($sign.' month');
                }
            }
        }
        $today_formated = $today->format("Y-m-d");
        if(!is_null($this->semestre_handler->projets())){
            foreach ($this->semestre_handler->projets()->get() as $semestre){
                if($today_formated >= $semestre->start->format("Y-m-d") && $today_formated <= $semestre->end->format("Y-m-d")){
                    if($gap = 0){
                        $semestre->is_active=true;
                    }
                    return $semestre;
                }
            }
        } // si pas de return => pas de semestre pour la date actuelle alors créer :

        $semestre = new Projet();
        if($gap = 0){
            $semestre->is_active=true;
        }
        $year = $today->format('Y');
        $month = $today->format('m');


        if($today->format("n") >= 8){ //créer un semestre de Septembre à Décembre
            $start = $year . '-08-01';
            $end = $year . '-12-' . cal_days_in_month(CAL_GREGORIAN, 12, $year); //dernier jour de décembre
        } else { //créer un semestre de Janvier à Août (limit @Juillet)
            $start = $year . '-01-01'; // 01 Janvier de l'année
            $end =  $year . '-07-' . cal_days_in_month(CAL_GREGORIAN, 8, $year); //dernier jour de Juillet de l'année
        }
        $semestre->start = \DateTime::createFromFormat($format,$start);
        $semestre->end = \DateTime::createFromFormat($format,$end);
        $semestre->container = $this->semestre_handler;
        $semestre->save();
        $this->save();
        return $semestre;
        #if(!is_null())


    }
    // TODO:
    //   - Can_see (hasMany users)
    //   - Manager (hasMany users)
    //   - Notify (hasMany users)

}
