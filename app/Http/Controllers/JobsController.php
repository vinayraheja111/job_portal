<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category,Job,JobType};

class JobsController extends Controller
{
    public function index(){
        $categoreis = Category::where('status',1)->orderBy('name','ASC')->get();
        $jobTypes = jobType::where('status',1)->get();
        $latestJobs = Job::with('jobType')->where('status',1)->orderBy('created_at','desc')->get();
        return view('front.jobs.jobs',compact('categoreis','latestJobs','jobTypes'));
    }

    public function jobDetails($id){
        $jobDetails = Job::with('jobType')->where('id',$id)->first();
        return view('front.jobs.job-detail',compact('jobDetails'));
    }
}
