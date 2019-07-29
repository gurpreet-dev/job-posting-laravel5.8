<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Session;
use Auth;
use DB;
class FaqController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function list(){
        $faqs = DB::table('faqs')->orderby('id', 'desc')->get();
        return view('admin.faq.list', ['faqs' => $faqs]);
    }
    public function add(Request $request){
        if($request->isMethod('post')){
            
            $post = request()->except(['_token']);
            $post['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $post['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $insert = DB::table('faqs')->insert($post);
            if($insert){
                return redirect('/admin/faq')->with('success','Faq has been created successfully!');
            } else {
                return back()
                            ->with('error','Error in adding faq');
            }
        }
        return view('admin.faq.add');
    }
    public function edit(Request $request, $id){
        $faq = DB::table('faqs')->where('id', $id)->first();
        if($request->isMethod('post')){
            
            $post = request()->except(['_token']);
            if(!isset($post['status'])){
                $post['status'] = 0;
            }
            $post['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $update = DB::table('faqs')->where('id', $id)->update($post);
            if($update){
                    return redirect('/admin/faq/')->with('success','Faq has been updated successfully');
            } else {
                return back()
                           ->with('error','Error in updating faq');
            }
        }
        return view('admin.faq.edit', ['faq' => $faq]);
    }
    public function change_status(Request $request, $id){
        $faq = DB::table('faqs')->where('id', $id)->first();
        if($faq->status == 1){
            $status = 0;
        }else{
            $status = 1;
        }
        $update = DB::table('faqs')->where('id', $id)->update(['status' => $status]);
        if($update){
            return redirect('/admin/faq/')->with('success','Status has been updated successfully');
        } else {
            return redirect('/admin/faq/')->with('error','Error in updating Status');
        }
    }
    public function view($id){
        $faq = DB::table('faqs')->where('id', $id)->first();
        return view('admin.faq.view', ['faq' => $faq]);
    }
    public function delete($id){
        $faq = DB::table('faqs')->where('id', $id)->first();
        if(!empty($faq)){
            DB::table('faqs')->where('id', $id)->delete();
        }
        return redirect('/admin/faq/')->with('success','Faq has been deleted successfully');
    }
}