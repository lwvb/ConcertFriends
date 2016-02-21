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

    public function listall(Request $request) {
    	$search = preg_replace('/[^\w\x80-\xFF\- :]/', '', $request->input('q'));
    	if(strlen($search)) {
    		$result = $this->concerts->search($search);
    	} else {
    		$result = $this->concerts->all();
    	}
        return view('concerts.list',['concerts' => $result['concerts'], 'search' => $search]);
    }

    public function map(Request $request) {
    	$search = preg_replace('/[^\w\x80-\xFF\- :]/', '', $request->input('q'));
    	if(strlen($search)) {
    		$result = $this->concerts->search($search);
    	} else {
    		$result = $this->concerts->all();
    	}
    	return view('concerts.map',['concerts' => $result['concerts'], 'search' => $search]);
    }

    public function show($concertId) {
    	return view('concerts.show',['concert' => $this->concerts->get($concertId)]);
    }

    public function edit($concertId = NULL) {
    	$concert = NULL;
		if($concertId) {
			$concert = $this->concerts->get($concertId);
            if($concert->hasOwner() && $concert->getOwner() !== \Auth::user()->getFacebookUid()){
                return redirect('/concert/'.$concertId);
            }

		}
		return view('concerts.edit',['concert' => $concert]);

    }

    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  Requests\CreatePageRequest $request
	 * @return Response
	 */
	public function store(Requests\EditConcertRequest $request) {
		$concert = new Concert(array_merge($request->all(),['startDate' => Carbon::now()->toIso8601String()]));
        $curl     = new \Ivory\HttpAdapter\CurlHttpAdapter();
        $geocoder = new \Geocoder\Provider\GoogleMaps($curl);
        $address = $geocoder->geocode($concert->getAddressString())->first();
        $concert->setLocation($address->getLatitude(),$address->getLongitude());
		$result = $this->concerts->save($concert);
		return redirect('/concert/'.$result['_id']);
	}

}
