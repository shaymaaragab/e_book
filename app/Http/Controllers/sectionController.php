<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class sectionController extends Controller
{
    //
    public function getIndex()
    {
    	$date=date('Y-m-d');
    	$time=date('H:i:s');
    	$sections=['art'=>'art.jpg','mechanic'=>'mechanic.jpg','history'=>'history.jpg','programming'=>'programming.jpg','comic'=>'comic.jpg','civil'=>'civil.jpg'];
    	return view('libaryViewContainer.library')->withDate($date)->withTime($time)->withSections($sections);
    }
}
