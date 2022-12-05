<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    //All jobs
    public function index()
    {
        // dd(request());
        return view('job.index', ['heading' =>
         "latest JobS", 'jobs' => Job::latest()->filter(request(["tag", "search"]))
         ->paginate(6)
        ]);
    }

    //job details page
    public function job(Job $Job)
    {
        return view('job.show', ['job' => $Job]);
    }

    // show create form 
    public function create(){
        return view('job.create');
    }

    // store job data
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('jobs', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Job::create($formFields);

        return redirect('/')->with('message', 'Job created successfully!');
    }

    // show edit  form
    public function edit(Job $job){
        // dd($job);
        return view('job.edit', ['job' => $job]);
    }
    
    // update job data
    public function update(Request $request, Job $job){

        // make sure logged in user is owner
        if($job->user_id != auth()->id()){
            abort(403, 'Unauthorized to perform this action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $job->update($formFields);

        return back()->with('message', 'Job updated successfully!');
    }

    public function destroy(Job $job){

        // make sure logged in user is owner
        if($job->user_id != auth()->id()){
            abort(403, 'Unauthorized to perform this action');
        }

        $job->delete();
        return redirect('/')->with('message', 'Job deleted successfully');
    }

    // manage jobs
    public function manage(){
        return view('job.manage', ['jobs' => auth()->user()->jobs()->get()]);
    }
}
