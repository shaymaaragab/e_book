<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Section extends Model
{
	use softDeletes;
	protected $table='section';
    protected $dates=["deleted_at"];
    //functiom to connect book with section
    public function books(){
    	return $this->hasMany('App\book','section_id','id');
    }

}
