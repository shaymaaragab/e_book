<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    //many to one //return the section that this book belongto
    protected $table='books';
    public function section(){
    return $this->belongsTo('App\Section','id','section_id');
       }
     public function authors(){
     	return $this->belongsToMany('App\Author','books_authors_relationship','book_id','author_id');
     }

}
