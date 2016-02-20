<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Concerts;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConcertController extends Controller
{
	protected $concerts;

	public function __construct() {
		$this->concerts = new Concerts();
	}
    public function listall() {
        $allConcerts = $this->concerts->all()['hits']['hits'];
        return view('concerts.list',['concerts' => $allConcerts]);
    }

    public function map() {
        return view('concerts.map');
    }

    public function show($concertId) {
    	return view('concerts.show',['concert' => $this->concerts->get($concertId)]);
    }
}
