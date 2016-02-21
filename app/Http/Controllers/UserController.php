<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users;

class UserController extends Controller
{
    public function show($facebookUid) {
    	$users = new Users();
    	//dd($users->findByFacebookUid($facebookUid));
    	return;
    }
}
