<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\JobApplicant;
use App\Company;
use App\Address;
use App\Subscription;
use DB;
use Auth;

class JobsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $filter = [];
        $job_type = isset($_GET['type']) ? $_GET['type'] : '';
        $jobs = Job::with(['applicants', 'hiredApplicants' => function($q){
            $q->where('status', 1);
        }])->where('user_id', Auth::id());

        if($job_type != ''){
            $jobs = $jobs->where('type', $job_type);
            $filter['type'] = $job_type;
        }
        $jobs = $jobs->orderBy('id', 'desc');
        $jobs = $jobs->simplePaginate(10);

        return view('site.jobs.list', ['jobs' => $jobs, 'job_type' => $job_type, 'filter' => $filter]);
    }

    public function post(Request $request){

        if(Auth::user()->subscribed == null){
            $subscriptions = Subscription::where('user_id', null)->get();
            if(!$subscriptions->isEmpty()){
                return redirect(route('job-posted'))->with('warning', 'Subscription Expired!');
            }else{
                return redirect(route('job-posted'))->with('warning', 'Click <a href="'.route('home').'/#subscription-plans">here</a> to subscribe in order to post a job.');
            }
        }

        $states = DB::table('states')->where('country_id', 223)->get();

        if($request->isMethod('post')){

            $post = $request->except(['_token']);

            $post['user_id'] = Auth::id();
            $post['actual_vacancies'] = $post['vacancies'];
            
            $images = [];
            
            if(isset($request->featured_image)){            
                $file = $request->file('featured_image');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/jobs'), $imageName); 
                $post['featured_image'] = $imageName;
                $images[] = $imageName;
            }

            if(isset($request->view_image)){            
                $file = $request->file('view_image');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/jobs'), $imageName); 
                $post['view_image'] = $imageName;
                $images[] = $imageName;
            }

            if(isset($request->interview_thumbnail)){            
                $file = $request->file('interview_thumbnail');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/jobs'), $imageName); 
                $post['interview_thumbnail'] = $imageName;
                $images[] = $imageName;
            }

            if(isset($request->interview_video)){            
                $file = $request->file('interview_video');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/jobs'), $imageName); 
                $post['interview_video'] = $imageName;
                $images[] = $imageName;
            }

            $create = Job::create($post);

            if($create){

                $subscription = Subscription::where('id', Auth::user()->subscription_id)->first();
                $jobs = Job::where('created_at', '>=', $subscription->payment_date)->count();

                if($jobs >= \App\SubscriptionPlan::getFeature('jobs_limit', Auth::user()->plan_id)){
                    Subscription::where('id', Auth::user()->subscription_id)->update(['status' => 2]);
                    User::where('id', Auth::id())->update(['subscribed' => 0, 'subscription_id' => null, 'plan_id' => null]);
                }

                return redirect(route('job-posted'))->with('success','Job has been posted successfully');

            }else{
                foreach($images as $image){
                    if($image != '' || $image != null){
                        if(file_exists(public_path('/images/jobs/'.$image))){
                            unlink(public_path('/images/jobs/'.$image));
                        }
                    }
                }

                return back()->withInput()->with('error','Some error has been occurred while posting a job. Please try again later!');

            }

        }

        return view('site.jobs.add', ['states' => $states]);
    }

    public function feed(){

        $filter = [];
        $job_type = isset($_GET['type']) ? $_GET['type'] : '';

        $jobs = Job::with(['applicants' => function($q){
            $q->where('user_id', Auth::id());
        }, 'isHired' => function($q){
            $q->where(['user_id' => Auth::id(), 'status' => 1]);
        }, 'hiredApplicants' => function($q){
            $q->where('status', 1);
        }])->where('status', 1);

        if($job_type != ''){
            $jobs = $jobs->where('type', $job_type)->where('hired_user', null);
            $filter['type'] = $job_type;
        }else{
            $jobs = $jobs->where('hired_user', null)->orWhere('hired_user', Auth::id());
        }

        $jobs = $jobs->orderBy('id', 'desc');
        $jobs = $jobs->simplePaginate(10);

        //dd($jobs);

        return view('site.jobs.feed', ['jobs' => $jobs, 'job_type' => $job_type, 'filter' => $filter]);
    }

    public function hired(){
        $jobs = Job::whereHas('isHired')->with(['isHired' => function($q){
            $q->where(['user_id' => Auth::id(), 'status' => 1]);
        }, 'hiredApplicants' => function($q){
            $q->where('status', 1);
        }])->orderBy('id', 'desc')->simplePaginate(10);

        return view('site.jobs.hired', ['jobs' => $jobs]);
    }

    public function apply(Request $request, $id){

        $job_id = \App\Hash::decode($id);

        $check = JobApplicant::where(['user_id' => Auth::id(), 'job_id' => $job_id])->first();
        
        if(!empty($check)){
            return redirect(route('job-feed'))->with('error', 'Application already sent!');
        }

        if($request->isMethod('post')){
            
            $post = $request->except(['_token']);
            $post['user_id'] = Auth::id();
            $post['job_id'] = $job_id;

            if(isset($request->document)){            
                $file = $request->file('document');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/documents'), $imageName); 
                $post['document'] = $imageName;

                $create = JobApplicant::create($post);

                return redirect(route('job-feed'))->with('success','Application sent successfully');

            }else{
                return back()->with('error','Application not sent. Please try again later!');
            }

        }

        return view('site.jobs.apply', ['id' => $id]);
    }

    public function view($id){

        $job = Job::find(\App\Hash::decode($id));

        if(empty($job)){
            return redirect(route('job-feed'))->with('error', 'Job not found!');
        }

        $company = Company::where('user_id', $job->user_id)->first();
        $address = Address::where('user_id', $job->user_id)->first();

        return view('site.jobs.view', ['job' => $job, 'company' => $company, 'address' => $address]);
    }

    public function edit(Request $request, $id){

        $job = Job::find(\App\Hash::decode($id));

        if(empty($job)){
            return redirect(route('job-posted'))->with('error', 'Job not found!');
        }

        if($request->isMethod('post')){
            $post = $request->except(['_token']);

            $post['user_id'] = Auth::id();

            $images = [];
            
            if(isset($request->featured_image)){
                
                if($job->featured_image != ''){
                    if(file_exists(public_path('/images/jobs/'.$job->featured_image))){
                        unlink(public_path('/images/jobs/'.$job->featured_image));
                    }
                }
                
                $file = $request->file('featured_image');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/jobs'), $imageName); 
                $post['featured_image'] = $imageName;
                $images[] = $imageName;
            }

            if(isset($request->view_image)){   
                
                if($job->view_image != ''){
                    if(file_exists(public_path('/images/jobs/'.$job->view_image))){
                        unlink(public_path('/images/jobs/'.$job->view_image));
                    }
                }
                
                $file = $request->file('view_image');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/jobs'), $imageName); 
                $post['view_image'] = $imageName;
                $images[] = $imageName;
            }

            if(isset($request->interview_thumbnail)){ 
                
                if($job->interview_thumbnail != ''){
                    if(file_exists(public_path('/images/jobs/'.$job->interview_thumbnail))){
                        unlink(public_path('/images/jobs/'.$job->interview_thumbnail));
                    }
                }

                $file = $request->file('interview_thumbnail');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/jobs'), $imageName); 
                $post['interview_thumbnail'] = $imageName;
                $images[] = $imageName;
            }

            if(isset($request->interview_video)){  
                
                if($job->interview_video != ''){
                    if(file_exists(public_path('/images/jobs/'.$job->interview_video))){
                        unlink(public_path('/images/jobs/'.$job->interview_video));
                    }
                }

                $file = $request->file('interview_video');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/jobs'), $imageName); 
                $post['interview_video'] = $imageName;
                $images[] = $imageName;
            }

            $hired = \App\JobApplicant::hiredUsers($job->id);

            if(!empty($hired)){
                if($post['vacancies'] > $hired){
                    $post['status'] = 1;
                }

                if($post['vacancies'] <= $hired){
                    $post['status'] = 0;
                }
            }

            $update = Job::where('id', $job->id)->update($post);

            if($update){
                return redirect(route('job-posted'))->with('success','Job has been updated successfully');
            }else{
                foreach($images as $image){
                    if($image != '' || $image != null){
                        if(file_exists(public_path('/images/jobs/'.$image))){
                            unlink(public_path('/images/jobs/'.$image));
                        }
                    }
                }

                return back()->withInput()->with('error','Some error has been occurred while updating a job. Please try again later!');

            }
        }

        $states = DB::table('states')->where('country_id', 223)->get();

        return view('site.jobs.edit', ['job' => $job, 'states' => $states]);
    }

    public function applicants($id){

        $job_id = \App\Hash::decode($id);

        $applicants = JobApplicant::with(['job'])->where('job_id', $job_id)->orderBy('id', 'desc')->simplePaginate(10);

        return view('site.jobs.applicants', ['job_id' => $job_id, 'applicants' => $applicants]);
    }

    public function applicant(Request $request, $job_id, $user_id){
        $job_id = \App\Hash::decode($job_id);
        $user_id = \App\Hash::decode($user_id);
        $job = Job::find($job_id);

        $info = JobApplicant::whereHas('user')->with(['user'])->where(['user_id' => $user_id, 'job_id' => $job_id])->first();

        if(empty($info)){
            return redirect(route('job-applicants', [\App\Hash::encode($job_id)]))->with('error', 'Applicant not found!');
        }

        if($request->isMethod('post')){

            $update = JobApplicant::where(['user_id' => $user_id, 'job_id' => $job_id])->update(['status' => 1]);

            if($update){

                $hired = \App\JobApplicant::hiredUsers($job_id);
                if(!empty($job)){
                    if($job->vacancies <= $hired){
                        Job::where('id', $job_id)->update(['status' => 0]);
                    }
                }

                return redirect(route('job-applicants', [\App\Hash::encode($job_id)]))->with('success','Applicant has been Hired successfully');
            }else{
                return redirect(route('job-applicants', [\App\Hash::encode($job_id)]))->with('error','Server error occurred while hiring user. Please try again later!');
            }
        }

        return view('site.jobs.applicant', ['job_id' => $job_id, 'info' => $info, 'job' => $job]);

    }

}
