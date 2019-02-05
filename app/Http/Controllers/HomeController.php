<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {

    	$male = Student::where('gender', 'male')->count();
    	$female = Student::where('gender', 'female')->count();

    	return view('home', compact('male', 'female'));
    }
}
