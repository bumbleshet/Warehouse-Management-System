<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sections';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'location_id'];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
