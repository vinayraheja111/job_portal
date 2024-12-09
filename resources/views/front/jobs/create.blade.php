@extends('front.layouts.app')

@section('content')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Post a Job</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            @include('front.layouts.sidebar')
            <div class="col-lg-9">
            	@if(Session::has('success'))
            	<div class="alert alert-success">
            		{{ Session::get('success') }}
            	</div>
            	@endif
            	<form method="post" action="{{ isset($job) ? url('update-job/' . $job->id) : url('save-job') }}">
            		@csrf
                <div class="card border-0 shadow mb-4 ">
                    <div class="card-body card-form p-4">
                        <h3 class="fs-4 mb-1">Job Details</h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Title<span class="req">*</span></label>
                                <input type="text" placeholder="Job Title" id="title" name="title" class="form-control" value="{{ $job->title ?? '' }}">
                                @error('title')<p class="text-danger">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="" class="mb-2">Category<span class="req">*</span></label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select a Category</option>
                                    @if(!empty($categories))
                                    @foreach($categories as $category)
                                     <option value="{{ $category->id }}" {{ $category->id == $job->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('category')<p class="text-danger">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                <select class="form-select" name="jobType">
                                   @if(!empty($jobTypes))
                                   @foreach($jobTypes as $jobType)
                                   <option value="{{ $jobType->id }}" {{ $jobType->id == $job->job_type_id ? 'selected' : ''}}>{{ $jobType->name }}</option>
                                   @endforeach
                                   @endif
                                </select>
                                @error('jobType')<p class="text-danger">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control" value="{{ $job->vacancy ?? '' }}">
                                @error('vacancy')<p class="text-danger">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Salary</label>
                                <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control" value="{{ $job->salary ?? '' }}">
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location<span class="req">*</span></label>
                                <input type="text" placeholder="location" id="location" name="location" class="form-control" value="{{ $job->location ?? '' }}">
                                 @error('location')<p class="text-danger">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Description<span class="req">*</span></label>
                            <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $job->description ?? '' }}</textarea>
                             @error('description')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Benefits</label>
                            <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits ?? '' }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Responsibility</label>
                            <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Qualifications</label>
                            <textarea class="form-control" name="qualification" id="qualification" cols="5" rows="5" placeholder="Qualifications">{{ $job->qualification ?? '' }}</textarea>
                        </div>
                        
                        

                        <div class="mb-4">
                            <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                            <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control" value="{{ $job->keywords ?? '' }}"> 
                        </div>

                         <div class="mb-4">
                                <label for="" class="mb-2">Experiance<span class="req">*</span></label>
                                <select name="experiance" id="experiance" class="form-control">
                                    <option value="">Select a experiance</option>
                                    <option value="1">1 Year</option>
                                    <option value="2">2 Years</option>
                                    <option value="3">3 Years</option>
                                    <option value="4">4 Years</option>
                                    <option value="5">5 Years</option>
                                    <option value="6">6 Years</option>
                                    <option value="7">7 Years</option>
                                    <option value="8">8 Years</option>
                                    <option value="9">9 Years</option>
                                    <option value="10">10 Years</option>
                                </select>
                                @error('experiance')<p class="text-danger">{{ $message }}</p>@enderror
                            </div>

                        <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Name<span class="req">*</span></label>
                                <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control" value="{{ $job->company_name ?? '' }}">
                                @error('company_name')<p class="text-danger">{{ $message }}</p>@enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location</label>
                                <input type="text" placeholder="Location" id="location" name="company_location" class="form-control" value="{{ $job->company_location ?? '' }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Website</label>
                            <input type="text" placeholder="Website" id="website" name="website" class="form-control" value="{{ $job->company_website ?? '' }}">
                        </div>
                    </div> 
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Save Job</button>
                    </div>               
            	</div>
            </form>
            
        </div>
    </div>
</section>

@endsection