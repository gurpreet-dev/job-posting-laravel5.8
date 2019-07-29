<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\User;
use App\Card;
use App\Experience;
use App\Address;
use App\Company;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function profile(){
        $user = User::find(Auth::id());
        return view('site.users.profile', ['user' => $user]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'unique:users,email,'.Auth::user()->id,
        ]);
    }

    public function editProfile(Request $request){
        if($request->isMethod('post')){

            $user = User::where('id', Auth::id())->first();

            $this->validator($request->all())->validate();

            $post = $request->except(['_token']);

            if(isset($request->image)){
                if($user->image != ''){
                    if(file_exists(public_path('/images/users/'.$user->image))){
                        unlink(public_path('/images/users/'.$user->image));
                    }
                }
            
                $file = $request->file('image');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/users'), $imageName); 
                $post['image'] = $imageName;
            }

            $update = User::where('id', Auth::id())->update($post);

            if($update){
                return redirect(route('user-profile'))->with('success','Profile updated successfully');
            }else{
                return back()->with('error','Error in updating profile. Please try after some time!');
            }
            
        }
        return view('site.users.edit-profile');
    }

    public function changePassword(Request $request){
        
        if($request->isMethod('post')){

            if(!Hash::check($request->opassword, Auth::user()->password)){ // Matching old password
                return back()->with('error','Current password is not correct!');
            }else{
                $password = Hash::make($request->password);
                $update = User::where('id', Auth::id())->update(['password' => $password]);

                if($update){
                    Auth::guard('web')->logout();
                    return redirect(route('login'))->with('success','Password Changed successfully. You have to login again with new password!');
                }else{
                    return back()->with('error','Error in changing password. Try again later!');
                }

            }

        }

        return view('site.users.change-password');

    }

    public function payment(Request $request){

        $card = Card::where('user_id', Auth::id())->first();

        if($request->isMethod('post')){
            
            if(empty($card)){
                $request['user_id'] = Auth::id();
                $insert = Card::create($request->except(['_token']));

                if($insert){
                    return back()->with('success','Card added successfully');
                }else{
                    return back()->with('error','Error in adding card');
                }
            }else{
                $update = Card::where('user_id', Auth::id())->update($request->except(['_token']));

                if($update){
                    return back()->with('success','Card updated successfully');
                }else{
                    return back()->with('error','Error in updating card');
                }
            }

        }
        return view('site.users.payment', ['card' => $card]);
    }

    public function shareExperience(Request $request){

        $experience = Experience::where('user_id', Auth::id())->first();

        if($request->isMethod('post')){
            
            if(empty($experience)){
                $request['user_id'] = Auth::id();
                $insert = Experience::create($request->except(['_token']));

                if($insert){
                    return back()->with('success','Experience added successfully');
                }else{
                    return back()->with('error','Error in adding Experience');
                }
            }else{
                $update = Experience::where('user_id', Auth::id())->update($request->except(['_token']));

                if($update){
                    return back()->with('success','Experience updated successfully');
                }else{
                    return back()->with('error','Error in updating experience');
                }
            }

        }

        return view('site.users.experience', ['experience' => $experience]);
    }

    public function address(Request $request){

        $address = Address::where('user_id', Auth::id())->first();
        $states = DB::table('states')->where('country_id', 223)->get();

        if($request->isMethod('post')){
            
            if(empty($address)){
                $request['user_id'] = Auth::id();
                $insert = Address::create($request->except(['_token']));

                if($insert){
                    return back()->with('success','Address added successfully');
                }else{
                    return back()->with('error','Error in adding address');
                }
            }else{
                $update = Address::where('user_id', Auth::id())->update($request->except(['_token']));

                if($update){
                    return back()->with('success','Address updated successfully');
                }else{
                    return back()->with('error','Error in updating address');
                }
            }

        }

        return view('site.users.address', ['address' => $address, 'states' => $states]);
    }

    public function companyInfo(Request $request){

        $company = Company::where('user_id', Auth::id())->first();

        if($request->isMethod('post')){
            
            $post = $request->except(['_token']);

            if(empty($company)){

                if(isset($request->image)){                
                    $file = $request->file('image');
                    $imageName = time().$file->getClientOriginalName();
                    $upload = $file->move(public_path('images/company'), $imageName); 
                    $post['image'] = $imageName;
                }

                $post['user_id'] = Auth::id();
                $insert = Company::create($post);

                if($insert){
                    return back()->with('success','Company info added successfully');
                }else{
                    return back()->with('error','Error in adding company');
                }
            }else{

                if(isset($request->image)){   
                        
                    if($company->image != ''){
                        if(file_exists(public_path('/images/company/'.$company->image))){
                            unlink(public_path('/images/company/'.$company->image));
                        }
                    }
                    
                    $file = $request->file('image');
                    $imageName = time().$file->getClientOriginalName();
                    $upload = $file->move(public_path('images/company'), $imageName); 
                    $post['image'] = $imageName;
                }

                $update = Company::where('user_id', Auth::id())->update($post);

                if($update){
                    return back()->with('success','Company info updated successfully');
                }else{
                    return back()->with('error','Error in updating company');
                }
            }

        }

        return view('site.users.company-info', ['company' => $company]);
    }
}
