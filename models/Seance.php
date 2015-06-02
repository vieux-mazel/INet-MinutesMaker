<?php namespace VM\MinuteMaker\Models;

use Model;
use VM\MinuteMaker\Models\Point as Point;
use VM\MinuteMaker\Models\StructureCategory as StructureCategory;
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
        'category' => ['VM\MinuteMaker\Models\StructureCategory'] //relation witrh StructureCategory~Seance => category_id in db
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
    /**
     * SCOP FUNCTION
     */

     /**
      * Fetch Seance with two slug Seance::Slug($slug,$catSlug);
      * @param Query $query   Automatic
      * @param string $slug   Seance slug
      * @param string $catSlug Category slug
      * @return query
      */
     public function scopeSlug($query, $slug, $catSlug){
         $cat = StructureCategory::whereSlug($catSlug)->first();
         return $query->where('category' == $cat)->whereSlug($slug);
     }

}
