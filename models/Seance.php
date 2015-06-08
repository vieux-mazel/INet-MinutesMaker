<?php namespace VM\MinuteMaker\Models;

use Model;
use VM\MinuteMaker\Models\Point as Point;
use VM\MinuteMaker\Models\StructureCategory as StructureCategory;
use VM\MinuteMaker\Models\Projet as Projet;
use VM\MinuteMaker\Models\ProjetContainer as ProjetContainer;
use Illuminate\Support\Str;
use VM\MinuteMaker\Models\Seance as Seances;
/**
 * seance Model
 */
class Seance extends Model
{

    use \October\Rain\Database\Traits\Sluggable;
    /**
     * @var array Auto generated slug
     */
    protected $slugs = ['slug' => 'id'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vm_minutemaker_seances';

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
        'points' => ['VM\MinuteMaker\Models\Point', 'order' => 'created_at'] //relation with Points
    ];
    public $belongsTo = [
        'category' => ['VM\MinuteMaker\Models\StructureCategory'], //relation witrh StructureCategory~Seance => category_id in db
        'projet' => ['VM\MinuteMaker\Models\Projet'],
         #'semestre_handler' => ['VM\MinuteMaker\Models\ProjetContainer', 'key' => 'semestre_id']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function addPoint($title, $order=0){ //order start at 1, 0 is for none set
        $point = new Point();
        $point->title = $title;
        $point->order = $order;
        $point->save();
    }


    public function notifyUsers(){
        //Notify Category watchers + Category Nofifier
        return true;
    }
    public function beforeCreate()
    {
        // Generate a URL slug for this model
        $this->slug = Str::slug($this->date->format('Y-m-d'));
    }

    public function getParent(){
        if(!$this->category_id == 0){
            return $this->category;
        } elseif (!$this->projet_id == 0){
            return $this->projet;
        } else{
            return $this->semestre_handler;
        }
    }
    public function getParentBySlug($slug){
        if(!$this->category_id == 0 ){
            return StructureCategory::whereSlug($slug)->first();
        } elseif (!$this->projet_id == 0){
            return $this->projet;
        } else{
            return ProjetContainer::whereSlug($slug)->first();
        }
    }
    public function getParentType(){
        if(!$this->category_id == 0 ){
            return 'category';
        } elseif (!$this->projet_id == 0){
            return 'projet';
        } else{
            return 'semestre';
        }
    }
    /**
     * SCOP FUNCTION
     */

     /**
      * Fetch Seance with two slug Seance::Slug($slug,$catSlug);
      * @param Query $query   Automatic
      * @param string $slug   Seance slug
      * @param string $catSlug parent Slug (projet, category or ProjetContainer)
      * @return query
      */
     public function scopeBySlug($query, $slug, $catSlug){
         #$parent = $this->getParentBySlug($parentSlug);
         #return $query->where($this->getParentType() .'_id' == $parent->id)->whereSlug($slug);
         $cat = StructureCategory::whereSlug($catSlug)->first();
         return $query->where('category' == $cat)->whereSlug($slug);
     }

}
