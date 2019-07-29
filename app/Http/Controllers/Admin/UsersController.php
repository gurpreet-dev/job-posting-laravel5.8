<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users.list', ['users' => $users]);
    }

    public function deletedUsers(){
        $users = User::orderBy('id', 'desc')->onlyTrashed()->get();
        return view('admin.users.deleted', ['users' => $users]);
    }

    public function restore($id){
        $restore = User::withTrashed()->find($id)->restore();
        if($restore){
            return back()->with('success','User has been restored successfully!');
        } else {
            return back()->with('error','Error in restoring user. Please try again later!');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'             => 'required|email|max:255|unique:users'
        ]);
    }
    
    public function add(Request $request)
    {
        if($request->isMethod('post')){
            $this->validator($request->all())->validate();
            $post = $request->all();
            $post['password'] = Hash::make($post['password']);
            $post['status'] =   1;
            $insert = User::create($post);
            if($insert){
                return redirect(route('admin.users'))->with('success','User has been added successfully!');
            } else {
                return back()->withInput()->with('error','Error in adding user. Please try again later!');
            }
        }
        return view('admin.users.add');
    }

    public function view($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.users.view', ['user' => $user]);
    }

    protected function EditValidator(array $data, $id)
    {
        return Validator::make($data, [
            'email'             => 'required|email|max:255|unique:users,email,'.$id
        ]);
    }
    public function edit(Request $request, $id)
    {

        $data = User::find($id);

        if($request->isMethod('post')){
            $this->EditValidator($request->all(), $id)->validate();
            
            $post = request()->except(['_token']);
            if(!isset($post['status'])){
                $post['status'] = 0;
            }
            $update = User::where('id', $id)->update($post);
            if($update){
                if($id == Auth::id()){
                    return redirect(route('edituser', $id))->with('success','Profile has been updated successfully');
                }else{
                    return redirect(route('admin.users'))->with('success','User has been updated successfully');
                }
               
            } else {
                return back()->withInput()->with('error','Error in updating user');
            }
        }

        return view('admin.users.edit', ['user' => $data]);
    }

    public function changepassword(Request $request, $id){
        
        if($request->isMethod('post')){
            $post = request()->except(['_token']);
            unset($post['npassword']);
            $post['password'] = Hash::make($post['password']);
            $update = User::where('id', $id)->update($post);
            if($update){
                return redirect(route('cpuser', $id))->with('success','Password has been changed successfully');
            } else {
                return redirect(route('cpuser', $id))->with('error','Error in updating nanny');
            }
        }
        $user = User::find($id);
        return view('admin.users.changepassword', ['user' => $user]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if($user->image != ''){
            if(file_exists(public_path('/images/users/'.$user->image))){
                unlink(public_path('/images/users/'.$user->image));
            }
        }
        
        $delete = User::where('id', $id)->delete();
        if($delete){
            \App\Job::where('user_id', $id)->delete();
            return redirect(route('admin.users'))->with('success','User has been deleted successfully');
        } else {
            return redirect(route('admin.users'))->with('error','Error in deleting user');
        }
    }

    public function set_featured(Request $request){
        if($request->isMethod('post')){
            $post = request()->except(['_token']);
            if(isset($post['featured'])){
                if(!empty($post['featured'])){
                    User::where('featured', 1)->update([ 'featured' => 0 ]);
                    foreach($post['featured'] as $value){
                        User::where('id', $value)->update([ 'featured' => 1 ]);
                    }
                }
            }
            
            return redirect('/admin/users')->with('success','Featured Service Providers has been updated successfully!');
            
        }
    }

    public function company($id){
        $company = \App\Company::where('user_id', $id)->first();
        $address = \App\Address::where('user_id', $id)->first();
        return view('admin.users.company', ['company' => $company, 'address' => $address]);
    }

}
