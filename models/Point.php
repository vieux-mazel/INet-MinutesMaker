<?php namespace VM\MinuteMaker\Models;

use Model;
use Illuminate\Support\Str as Str;
/**
 * point Model
 */
class Point extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    /**
     * @var string The database table used by the model.
     */
    public $table = 'vm_minutemaker_points';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Auto generated slug
     */
    protected $slugs = ['slug' => 'id'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'seance' => ['VM\MinuteMaker\Models\Seance'] //relation witrh Seance~Point => seance_id in db
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function beforeCreate(){
        // Generate slug if it's a parent's tracked point
        if($this->is_tracked){
            if(!$this->first_id){
                $slug_str = 'discussion_'.
                if($this->seance->category->title){
                    $slug_str . $this->seance->category->title;
                }
                $sluf_str . date("Ymd_hi_") . Str::random(4); //add time stamp + random char to slug
                $this->slug = Str::slug($sluf_str); //set slug
            }
        // If none set slug to null
        }else{
            $this->slug = NULL;
        }
    }
    /**
     * Move order to +1
     * @param [type] $order [description]
     */
    public function moveUp(){
        $this->order++;
        $this->save();

    }

    public function moveDown(){
        $this->order--;
        $this->save();

    }


    /**
     * SCOP FUNCTION
     *   public function scopeOfType($query, $type){
     *   	return $query->whereType($type);
     *   }
     *
     *   public function scopePopular($query){
     *   	return $query->whereType($type);
     *   }
     */
     public function scopeOrder($query, $order){
         return $query->where('order' == $order);
     }

}
