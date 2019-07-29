<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
    use SoftDeletes;

    protected $table = 'subscription_plans';
    protected $guarded=[];
    public function features(){
        return $this->hasMany('App\SubscriptionPlanFeatures', 'plan_id', 'id');
    }
    public static function durations(){
        $durations = ['monthly' => 'Monthly', 'annually' => 'Annually'];
        return $durations;
    }
    public static function feature_types(){
        $features = [
            [
                'name'          =>  'jobs_limit',
                'type'          =>  'number',
                'label'         =>  'Limit Of Posted Jobs',
                'front_label'   =>  'Post %s Jobs',
                'placeholder'   =>  'Enter No. of Jobs',
                'validation'    =>  'required|between:0,99',
                'class'         =>  'gpnumbers_only'
            ]
            // [
            //     'name'          =>  'live_chat',
            //     'type'          =>  'select',
            //     'label'         =>  'Live chat',
            //     'front_label'   =>  '%s live chat',
            //     'alert'         =>  'For unlimited, Type -1',
            //     'validation'    =>  'required|between:0,99',
            //     'options'       =>  [
            //         'yes'   =>  'Yes',
            //         'no'    =>  'No'
            //     ]
            // ]
        ];
        return $features;
    }
    public static function feature_type($meta_key){
        $features = [
            [
                'name'          =>  'transaction_fees',
                'type'          =>  'number',
                'label'         =>  'Transaction Fees',
                'front_label'   =>  '%s%% Transaction Fees',
                'placeholder'   =>  'Enter percentage',
                'validation'    =>  'required|between:0,99.99'
            ],
            [
                'name'          =>  'upload_courses',
                'type'          =>  'number',
                'label'         =>  'Upload Course limit',
                'front_label'   =>  '%s courses',
                'placeholder'   =>  'Enter limit',
                'alert'         =>  'For unlimited, Type -1',
                'validation'    =>  'required|between:0,99.99'
            ],
            [
                'name'          =>  'student_register',
                'type'          =>  'number',
                'label'         =>  'Limit of student registration',
                'front_label'   =>  '%s student registration',
                'placeholder'   =>  'Enter Limit',
                'alert'         =>  'For unlimited, Type -1',
                'validation'    =>  'required|between:0,99'
            ],
            [
                'name'          =>  'live_chat',
                'type'          =>  'select',
                'label'         =>  'Live chat',
                'front_label'   =>  '%s Live chat',
                'alert'         =>  'For unlimited, Type -1',
                'validation'    =>  'required|between:0,99',
                'options'       =>  [
                    'yes'   =>  'Yes',
                    'no'    =>  'No'
                ]
            ],
            [
                'name'          =>  'test',
                'type'          =>  'select',
                'label'         =>  'Test',
                'front_label'   =>  '%s Test',
                'alert'         =>  '',
                'validation'    =>  'required|between:0,99',
                'options'       =>  [
                    'yes'   =>  'Yes',
                    'no'    =>  'No'
                ]
            ],
            [
                'name'          =>  'certificate',
                'type'          =>  'select',
                'label'         =>  'Certificate',
                'front_label'   =>  '%s Certificate',
                'alert'         =>  'For unlimited, Type -1',
                'validation'    =>  'required|between:0,99',
                'options'       =>  [
                    'yes'   =>  'Yes',
                    'no'    =>  'No'
                ]
            ]
        ];
        foreach ($features as $key => $val) {
            if ($val['name'] === $meta_key) {
                return $val['front_label'];
            }
        }
        return null;
    }
    public static function getFeature($key, $id){
        $data = DB::table('subscription_plan_features')->where([ 'plan_id' => $id, 'meta_key' => $key ])->first();
        if(!empty($data)){
            return $data->meta_value;
        }else{
            return '';
        }
    }

    public static function getPlan($id){
        $data = \App\SubscriptionPlan::where('id', $id)->withTrashed()->first();
        if(!empty($data)){
            return $data;
        }else{
            return [];
        }
    }

}