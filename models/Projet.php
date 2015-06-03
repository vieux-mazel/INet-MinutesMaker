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
    public $hasMany = [];
    public $belongsTo = [
        'container' => ['VM\MinuteMaker\Models\ProjetContainer']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}
