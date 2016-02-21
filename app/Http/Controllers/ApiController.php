<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Concerts;

class ApiController extends Controller
{
	protected $concerts;

	public function __construct() {
		$this->concerts = new Concerts();
	}

	public function markers(Request $request) {
    	$search = preg_replace('/[^\w\x80-\xFF\- :]/', '', $request->input('q'));
    	if(strlen($search)) {
    		$result = $this->concerts->search($search);
    	} else {
    		$result = $this->concerts->all();
    	}
    	$markerData = array_map(function($concert) { return $concert->getMarkerData();} , $result['concerts']);
        return response()->json($markerData);
	}
}
