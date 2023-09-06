<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
   public function show(Request $request){

        //print_r($request->all());
        return view('dashboard');
   }
}
