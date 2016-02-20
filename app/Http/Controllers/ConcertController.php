<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Concert;
use App\Concerts;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ConcertController extends Controller
{
	protected $concerts;

	public function __construct() {
		$this->concerts = new Concerts();
	}
    public function listall() {
        $allConcerts = $this->concerts->all();
        return view('concerts.list',['concerts' => $allConcerts['concerts']]);
    }

    public function map() {
        return view('concerts.map');
    }

    public function show($concertId) {
    	return view('concerts.show',['concert' => $this->concerts->get($concertId)]);
    }

    public function edit($concertId = NULL) {
    	$concertData = NULL;
		if($concertId) {
			$concertData = $this->concerts->get($concertId);
		}
		return view('concerts.edit',['concert' => $concertData]);

    }

    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  Requests\CreatePageRequest $request
	 * @return Response
	 */
	public function store(Requests\EditConcertRequest $request) {
		$concert = new Concert(array_merge($request->all(),['startDate' => Carbon::now()->toIso8601String()]));
		$this->concerts->save($concert);
		return redirect('/list');
	}


    public function autoComplete($term) {
        return json_encode([]);
    }
}
