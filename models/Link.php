<?php namespace VM\MinuteMaker\Models;

use Model;

/**
 * link Model
 */
class Link extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vm_minutemaker_links';

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
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}