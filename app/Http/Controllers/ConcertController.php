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

    public function edit($concertId) {
		return view('concerts.edit',['concert' => $this->concerts->get($concertId)]);
    }

    	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Requests\CreatePageRequest $request
	 * @return Response
	 */
	public function store(Requests\EditConcertRequest $request) {
		$concert = $request->all();

		if (isset($newPage['image'])) {
			$image = Input::file('image');
			$fileName = $image->getClientOriginalName();
			$path = public_path('images/theme/');
			$image->move($path, $fileName);
			$newPage['image'] = $fileName;
		}
		Page::create($newPage);

		return redirect('editor');
	}


    public function autoComplete($term) {
        // TODO
        return json_encode([]);
    }
}
