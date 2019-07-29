<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Config;
use App\Contact;
use App\User;
use App\Job;

class ExtrasController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $data = [];
        $data['applicants'] = User::where('role', 'applicant')->count();
        $data['doctors'] = User::where('role', 'doctor')->count();
        $data['jobs'] = Job::count();
        $data['subscribed_users'] = User::where('subscribed', 1)->count();
        $data['latest_users'] = User::orderBy('id', 'desc')->skip(0)->take(5)->get();
        $data['latest_jobs'] = Job::whereHas('user')->with(['user'])->orderBy('id', 'desc')->skip(0)->take(5)->get();
        return view('admin.dashboard', ['data' => $data]);
    }

    public function config(Request $request){
        if($request->isMethod('post')){
            foreach($request->all() as $key => $value){
                if($request->hasFile($key)){
                    Config::updateAll($key, $value, 'file');
                }else{
                    Config::updateAll($key, $value, 'text');
                }
            }
            return redirect('admin/config')->with('success', 'A settings has been saved successfully.');
        }
        return view('admin.extras.config');
    }

    /**************************/
    public function contacts(){
    	$contacts = DB::table('contacts')->orderby('id', 'desc')->get();
    	return view('admin.extras.contacts', ['contacts' => $contacts]);
    }

    public function editContact(Request $request, $id){
    	if($request->isMethod('post')){
    		$post = $request->except('_token');
    		$update = Contact::where('id', $id)->update($post);
            
            if($update){
                Mail::send('emails.contact_to_user', ['data' => $post], function ($message) use($post)
                {
                    $message->to($post['email'], \App\Config::get_field('site_title'))->subject('Contact us query answered');
                    $message->from(\App\Config::get_field('email'), \App\Config::get_field('site_title'));
                
                });
                return redirect('admin/contacts')->with('success', 'A query has been answered successfully.');
            }else{
                return redirect('admin/contacts/edit/'.$id)->with('error', 'Error in answering a query. Please try again');
            }
    	}
    	$contact = DB::table('contacts')->where('id', $id)->orderby('id', 'desc')->first();
    	return view('admin.extras.edit_contact', ['contact' => $contact]);
    }

    /************ Pages *************/
    public function pages(){
        $pages = DB::table('static_pages')->orderby('id', 'desc')->get();
        return view('admin.pages.pages', ['pages' => $pages]);
    }

    public function addPage(Request $request){
        if($request->isMethod('post')){
            $post = $request->except('_token');
            $post1['slug']   =   strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $post['title']));
            $post1['title'] = $post['title'];
            $post1['content'] = $post['content'];
            $post1['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $post1['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $insert = DB::table('static_pages')->insert($post1);
            if($insert){
                return redirect('admin/pages')->with('success', 'Page has been added successfully');
            }else{
                return redirect(route('addpage'))->with('error', 'Error in adding page. please try again later');
            }
        }
        return view('admin.pages.add');
    }

    public function editPage(Request $request, $id){
        $page = DB::table('static_pages')->where('id', $id)->first();
        if($request->isMethod('post')){
            $post = $request->except('_token');
            if(!isset($request->status)){
                $post1['status'] = 0;
            }else{
                $post1['status'] = 1;
            }
            $post1['slug']   =   strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $post['title']));
            $post1['title'] = $post['title'];
            $post1['content'] = $post['content'];
            $post1['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $insert = DB::table('static_pages')->where('id', $id)->update($post1);
            if($insert){
                return redirect('admin/pages')->with('success', 'Page has been updated successfully');
            }else{
                return redirect(route('editpage', ['id' => $id]))->with('error', 'Error in adding page. please try again later');
            }
        }
        return view('admin.pages.edit', ['page' => $page]);
    }
    
    public function deletePage($id){
        $delete = DB::table('static_pages')->where('id', $id)->delete();
        if($delete){
            return redirect('admin/pages')->with('success', 'Page has been deleted successfully');
        }else{
            return redirect('admin/pages')->with('error', 'Error in deleting page. please try again later');
        }
    }

    public function experiences(){
        $experiences = \App\Experience::whereHas('user')->with(['user'])->orderBy('id', 'desc')->get();
        return view('admin.extras.experiences', ['experiences' => $experiences]);
    }

    public function setFeaturedExperience(Request $request){
        if($request->isMethod('post')){
            $post = request()->except(['_token']);
            if(isset($post['featured'])){
                if(!empty($post['featured'])){
                    \App\Experience::where('featured', 1)->update([ 'featured' => 0 ]);
                    foreach($post['featured'] as $value){
                        \App\Experience::where('id', $value)->update([ 'featured' => 1 ]);
                    }
                }
            }
            
            return redirect(route('admin.experiences'))->with('success','Featued Experiences has been updated successfully!');
            
        }
    }
}
