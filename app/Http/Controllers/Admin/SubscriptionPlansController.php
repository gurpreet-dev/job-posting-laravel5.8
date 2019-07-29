<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\SubscriptionPlan;
use App\SubscriptionPlanFeatures;

class SubscriptionPlansController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function list(){
        
        $plans = SubscriptionPlan::orderby('id', 'desc')->get();
        return view('admin.subscription_plans.list', ['plans' => $plans]);
    }
    protected function validator(array $data)
    {
        $types = SubscriptionPlan::feature_types();
        $values = [];
        foreach($types as $type){
            $values[$type['name']]  =   $type['validation'];
        }
        return Validator::make($data, $values);
    }
    public function add( Request $request ){
        if($request->isMethod('post')){
            $features = $request['features'];
            unset($request['features']);
            $insert = SubscriptionPlan::create(request()->except(['_token']));
            if($insert){
                foreach($features as $key => $value){
                    $post = [
                        'plan_id'       =>  $insert->id,
                        'meta_key'      =>  $key,
                        'meta_value'    =>  $value
                    ];
                    SubscriptionPlanFeatures::create($post);
                }
                return redirect('/admin/plans')->with('success','Subscription Plan has been added successfully!');
            } else {
                return back()
                           ->with('error','Error in adding subscription plan');
            }
        }
        return view('admin.subscription_plans.add');
    }
    public function edit( Request $request, $id ){
        
        if($request->isMethod('post')){
            $features = $request['features'];
            unset($request['features']);
            $update = SubscriptionPlan::where('id', $id)->update(request()->except(['_token']));
            if($update){
                
                SubscriptionPlanFeatures::where('plan_id', $id)->delete();
                
                foreach($features as $key => $value){
                    $post = [
                        'plan_id'       =>  $id,
                        'meta_key'      =>  $key,
                        'meta_value'    =>  $value
                    ];
                    SubscriptionPlanFeatures::create($post);
                }
                return redirect('/admin/plans')->with('success','Subscription Plan has been updated successfully!');
            } else {
                return back()
                           ->with('error','Error in updating subscription plan');
            }
        }
        $plan = SubscriptionPlan::where('id', $id)->first();
        return view('admin.subscription_plans.edit', ['plan' => $plan]);
    }

    public function delete( $id ){
        SubscriptionPlan::destroy($id);
        SubscriptionPlanFeatures::where('plan_id', $id)->delete();

        return redirect('/admin/plans')->with('success','Subscription Plan has been deleted successfully!');

    }
}