<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Job;
use App\JobApplicant;

class JobsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // $filter = [];
        // $filter_status = isset($_GET['status']) ? $_GET['status'] : '';

        $jobs = Job::whereHas('user')->with(['user', 'applicants'])->orderBy('id', 'desc');

        // if($filter_status != ''){
        //     $jobs = $jobs->where('status', $filter_status);
        //     $filter['status'] = $filter_status;
        // }

        //$jobs = $jobs->simplePaginate(10);
        $jobs = $jobs->get();

        return view('admin.jobs.list', ['jobs' => $jobs]);
    }

    public function view($id){
        $job = Job::whereHas('user')->with(['user', 'hiredUser'])->where('id', $id)->first();
        return view('admin.jobs.view', ['job' => $job]);
    }

    public function applicants($id){
        $job = Job::with(['applicants' => function($q){
            $q->with(['user']);
        }])->where('id', $id)->first();
        return view('admin.jobs.applicants', ['job' => $job]);
    }

    public function applicant($id){
        $applicant = JobApplicant::with(['job', 'user'])->where('id', $id)->first();
        return view('admin.jobs.applicant', ['applicant' => $applicant]);
    }

    public function delete($id){
        if($id){

            $job = Job::find($id);

            if(!empty($job)){
                
                if($job->featured_image != ''){
                    if(file_exists(public_path('/images/jobs/'.$job->featured_image))){
                        unlink(public_path('/images/jobs/'.$job->featured_image));
                    }
                }

                if($job->view_image != ''){
                    if(file_exists(public_path('/images/jobs/'.$job->view_image))){
                        unlink(public_path('/images/jobs/'.$job->view_image));
                    }
                }

                if($job->interview_thumbnail != ''){
                    if(file_exists(public_path('/images/jobs/'.$job->interview_thumbnail))){
                        unlink(public_path('/images/jobs/'.$job->interview_thumbnail));
                    }
                }

                if($job->interview_video != ''){
                    if(file_exists(public_path('/images/jobs/'.$job->interview_video))){
                        unlink(public_path('/images/jobs/'.$job->interview_video));
                    }
                }

                Job::where('id', $id)->delete();
                JobApplicant::where('job_id', $id)->delete();

                return redirect(route('admin.jobs'))->with('success','Job has been deleted successfully');

            }else{
                return redirect(route('admin.jobs'))->with('error','Server error has been occurred while deleting a job!');
            }            
        }else{
            return redirect(route('admin.jobs'))->with('error','Server error has been occurred while deleting a job!');
        }
    }

    public function setFeaturedJobs(Request $request){
        if($request->isMethod('post')){
            $post = request()->except(['_token']);
            if(isset($post['featured'])){
                if(!empty($post['featured'])){
                    Job::where('featured', 1)->update([ 'featured' => 0 ]);
                    foreach($post['featured'] as $value){
                        Job::where('id', $value)->update([ 'featured' => 1 ]);
                    }
                }
            }
            
            return redirect(route('admin.jobs'))->with('success','Top Rated Jobs has been updated successfully!');
            
        }
    }
}
