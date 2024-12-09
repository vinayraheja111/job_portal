<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Hash,Auth;
use App\Models\{User,Category,JobType,Job};

class AccountController extends Controller
{
    public function index(){
        return view('front.registration');
    }

    public function processRegistration(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|',
            'confirm_password' => 'required|min:5|same:password'
        ]);

        if($validator->fails()){
            return response()->json(['status' => false,'errors' => $validator->errors()]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('success','You have successfully Register.');

        return response()->json(['status' => true, 'errors' => []]);

    }

    public function login(){
        return view('front.login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
             'email' => 'required|email',
             'password' => 'required'
        ]);

        if($validator->fails()){
            // return response()->json(['status' => false, 'errors' => $validator->errors()]);
            return redirect()->back()->withErrors($validator)->withInput($request->only('email'));
        }
       // dd($request->all());
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('account.profile');
        }else{
            return redirect()->route('login')->with('error','Either Email/Password is Incorrect.');
        }
    }

    public function profile(){
        return view('front.account');
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(),[
              'name' => 'required|min:5|max:20',
              'email' => 'required|email|unique:users,email,'.$id,
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        // dd($request->all());
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->desgination = $request->designation;
        $user->save();

        return redirect()->back()->with('success','Profile Updated successfully');

    }

    public function updateProfileImage(Request $request){
        $validator = Validator::make($request->all(),[
            'image' => 'required|image'
        ]);

        if($validator->fails()){
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        $image = $request->file('image'); 
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/profile_pic'), $imageName);

        User::where('id',Auth::user()->id)->update(['image' => $imageName]);

        session()->flash('success','ProfileImage Updated successfully');

        return response()->json(['status' => true, 'errors' => []]);
    }

    public function createJob(Request $request){
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $jobTypes = JobType::orderBy('name','ASC')->where('status',1)->get();

        return view('front.jobs.create',compact('categories','jobTypes'));
    }

    public function saveJobs(Request $request){
        $validator = Validator::make($request->all(),[
            'title' =>'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required',
            'location' => 'required',
            'description' => 'required',
            'experiance' => 'required',
            'company_name' => 'required|min:3|max:75'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $job = new Job();
        $job->user_id = Auth::user()->id;
        $job->title = $request->title;
        $job->category_id = $request->category;
        $job->job_type_id = $request->jobType;
        $job->vacancy = $request->vacancy;
        $job->salary = $request->salary;
        $job->location = $request->location;
        $job->description = $request->description;
        $job->benefits = $request->benefits;
        $job->qualification = $request->qualification;
        $job->experiance = $request->experiance;
        $job->company_name = $request->company_name;
        $job->company_location = $request->company_location;
        $job->company_website = $request->website;
        $job->experiance = $request->experiance;
        $job->save();

        return redirect()->back()->with('success','Job Created Successfully');
    }

    public function myJobs(Request $request){

        $jobs = Job::with(['jobType','category'])->orderBy('id','desc')->where('user_id',Auth::user()->id)->paginate(5);

        return view('front.jobs.my-jobs',compact('jobs'));
    }

    public function editJob($id){
        $job = Job::find($id);
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $jobTypes = JobType::orderBy('name','ASC')->where('status',1)->get();
        return view('front.jobs.create',compact('job','categories','jobTypes'));
    }

    public function updateJob(Request $request,$id){
         $validator = Validator::make($request->all(),[
            'title' =>'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required',
            'location' => 'required',
            'description' => 'required',
            'experiance' => 'required',
            'company_name' => 'required|min:3|max:75'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $job = job::find($id);
        $job->user_id = Auth::user()->id;
        $job->title = $request->title;
        $job->category_id = $request->category;
        $job->job_type_id = $request->jobType;
        $job->vacancy = $request->vacancy;
        $job->salary = $request->salary;
        $job->location = $request->location;
        $job->description = $request->description;
        $job->benefits = $request->benefits;
        $job->qualification = $request->qualification;
        $job->experiance = $request->experiance;
        $job->company_name = $request->company_name;
        $job->company_location = $request->company_location;
        $job->company_website = $request->website;
        $job->experiance = $request->experiance;
        $job->save();

        return redirect('my-jobs')->with('sucess','Job updated successfully');

    }

    public function deleteJob(Request $request,$id){
        $job = Job::find($id);
        $job->delete();
        return redirect('my-jobs')->with('success','Job deleted successfully');

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
