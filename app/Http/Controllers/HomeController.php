<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category,Job,JobTyp};

class HomeController extends Controller
{
    public function index(){
        $categoreis = Category::where('status',1)->orderBy('name','ASC')->take(8)->get();
        $featJobs = Job::with('jobType')->where('status',1)->where('is_featured',1)->take(6)->get();
        $latestJobs = Job::with('jobType')->where('status',1)->orderBy('created_at','desc')->take(6)->get();
        return view ('front.home',compact('categoreis','featJobs','latestJobs'));
    }


}
