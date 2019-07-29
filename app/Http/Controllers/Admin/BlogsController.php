<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Blog;
use Auth;
use Illuminate\Support\Facades\Validator;
class BlogsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function list_blog(){
        $blogs = Blog::orderBy('id', 'desc')->get();
        
        return view('admin.blogs.list', ['blogs' => $blogs]);
        
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title'             => 'required|max:255|unique:blogs'
        ]);
    }

    public function add_blog(Request $request){
        if($request->isMethod('post')){
            $request['title'] = trim($request->title);
            $this->validator($request->all())->validate();
            $image = $request->image;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = time().str_random(10).'.'.'png';
            $upload = \File::put(public_path('images/blog'). '/' . $imageName, base64_decode($image));
             if($upload){
                $post = request()->except(['_token']);
                $post['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
                $post['image'] = $imageName;
                unset($post['image2']);
                $insert = Blog::create($post);
                if($insert){
                    return redirect('/admin/blog')->with('success','Blog has been created successfully!');
                } else {
                    return back()
                                ->with('error','Error in adding Blog');
                }
            }else {
                return back()
                            ->with('error','Error in adding Blog');
            }
        }

        return view('admin.blogs.add');
    }

    protected function EditValidator(array $data, $id)
    {
        return Validator::make($data, [
            'title'             => 'required|max:255|unique:blogs,title,'.$id
        ]);
    }

    public function edit_blog(Request $request, $id){
        $Blog = Blog::where('id', $id)->first();
        if($request->isMethod('post')){
            $request['title'] = trim($request->title);
            $this->EditValidator($request->all(), $id)->validate();
            
            $post = request()->except(['_token']);
            if(!isset($post['status'])){
                $post['status'] = 0;
            }
            if($post['image'] != null){
                if($Blog->image != ''){
                    if(file_exists(public_path('/images/blog/'.$Blog->image))){
                        unlink(public_path('/images/blog/'.$Blog->image));
                    }
                }
                
                $image = $post['image'];  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                
                $image = str_replace(' ', '+', $image);
                $imageName = time().str_random(10).'.'.'png';
                $upload = \File::put(public_path('images/blog'). '/' . $imageName, base64_decode($image));
                if($upload){
                    $post['image'] = $imageName;
                }else{
                    unset($post['image']);
                }
            }else{
                unset($post['image']);
            }
            $post['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
            
            $update = Blog::where('id', $id)->update($post);
            if($update){
                    return redirect('/admin/blog/')->with('success','Blog has been updated successfully');
            } else {
                return back()
                           ->with('error','Error in updating Blog');
            }
        }
        
        return view('admin.blogs.edit', ['data' => $Blog]);
    }
    public function delete_blog($id){
        $blog = Blog::where('id', $id)->first();
        if(!empty($blog)){
            Blog::where('id', $id)->delete();
            if($blog->image != ''){
                if(file_exists(public_path('/images/blog/'.$blog->image))){
                    unlink(public_path('/images/blog/'.$blog->image));
                }
            }
        }
        return redirect('/admin/blog/')->with('success','Blog has been deleted successfully');
    }

    public function change_status_blog(Request $request, $id){
        $blog = Blog::where('id', $id)->first();
        if($blog->status == 1){
            $status = 0;
        }else{
            $status = 1;
        }
        $update = Blog::where('id', $id)->update(['status' => $status]);
        if($update){
            return redirect('/admin/blog/')->with('success','Status has been updated successfully');
        } else {
            return redirect('/admin/blog/')->with('error','Error in updating Status');
        }
    }
    
}