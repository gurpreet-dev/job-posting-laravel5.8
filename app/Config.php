<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class Config extends Model
{
    protected $table = 'config';
    protected $guarded=[];
    public static function fields(){

        $pages = DB::table('static_pages')->where('status', 1)->get();

        $pagess = [];

        foreach($pages as $page){
            $pagess[$page->slug] = $page->title;
        }

        $fields = [
            'Website' =>
                [
                    [
                        'name'          =>  'site_title',
                        'type'          =>  'text',
                        'label'         =>  'Website Title',
                        'placeholder'   =>  'Enter Website Title'
                    ],
                    [
                        'name'          =>  'logo',
                        'type'          =>  'file',
                        'label'         =>  'Logo'
                    ],
                    [
                        'name'          =>  'favicon',
                        'type'          =>  'file',
                        'label'         =>  'Favicon'
                    ]
                ],
            'Homepage' =>
                [
                    [
                        'name'          =>  'large_banner_text',
                        'type'          =>  'text',
                        'label'         =>  'Large Banner Text',
                        'placeholder'   =>  'Enter Large Banner Text'
                    ],
                    [
                        'name'          =>  'small_banner_text',
                        'type'          =>  'text',
                        'label'         =>  'Large Banner Text',
                        'placeholder'   =>  'Enter Large Banner Text'
                    ],
                    [
                        'name'          =>  'home_banner',
                        'type'          =>  'file',
                        'label'         =>  'Homepage Banner'
                    ]
                ],
            
            'Footer' =>
            [
                [
                    'name'          =>  'facebook_link',
                    'type'          =>  'text',
                    'label'         =>  'Facebook Link',
                    'placeholder'   =>  'Enter Facebook link'
                ],
                [
                    'name'          =>  'twitter_link',
                    'type'          =>  'text',
                    'label'         =>  'Twitter Link',
                    'placeholder'   =>  'Enter Twitter link'
                ],
                [
                    'name'          =>  'linkedin_link',
                    'type'          =>  'text',
                    'label'         =>  'Linkedin Link',
                    'placeholder'   =>  'Enter Linkedin link'
                ],
                [
                    'name'          =>  'youtube_link',
                    'type'          =>  'text',
                    'label'         =>  'Youtube Link',
                    'placeholder'   =>  'Enter Youtube link'
                ],
                [
                    'name'          =>  'disclaimer',
                    'type'          =>  'text',
                    'label'         =>  'Disclaimer',
                    'placeholder'   =>  'Enter Disclaimer'
                ],
                [
                    'name'          =>  'copyright',
                    'type'          =>  'text',
                    'label'         =>  'Copyright',
                    'placeholder'   =>  'Copyright'
                ]
            ],
            'Basic Info' =>
            [
                [
                    'name'          =>  'address',
                    'type'          =>  'text',
                    'label'         =>  'Your Address',
                    'placeholder'   =>  'Enter Your Address'
                ],
                [
                    'name'          =>  'phone',
                    'type'          =>  'text',
                    'label'         =>  'Your Phone',
                    'placeholder'   =>  'Enter Phone'
                ],
                [
                    'name'          =>  'email',
                    'type'          =>  'text',
                    'label'         =>  'Your Email',
                    'placeholder'   =>  'Enter Email'
                ],
            ],
            'Pages' =>
            [
                [
                    'name'          =>  'privacy_policy',
                    'type'          =>  'select',
                    'label'         =>  'Privacy Policy',
                    'options'       =>  $pagess
                ],
                [
                    'name'          =>  'terms_condition',
                    'type'          =>  'select',
                    'label'         =>  'Terms & Conditions',
                    'options'       =>  $pagess
                ],
                [
                    'name'          =>  'faq',
                    'type'          =>  'select',
                    'label'         =>  'Faq',
                    'options'       =>  $pagess
                ],
                [
                    'name'          =>  'about_us',
                    'type'          =>  'select',
                    'label'         =>  'About Us',
                    'options'       =>  $pagess
                ]
            ]
        ];
        return $fields;
    }
    public static function get_field($key){
        $data = DB::table('config')->where([ 'meta_key' =>  $key ])->first();
        if(!empty($data)){
            return $data->meta_value;
        }else{
            return '';
        }
    }
    public static function updateAll($key, $value, $type){
        $data = DB::table('config')->where([ 'meta_key' =>  $key ])->first();
        if($type == 'file'){
            if(!empty($data)){
                if($data->meta_value != ''){
                    if(file_exists(public_path('/images/config/'.$data->meta_value))){
                        unlink(public_path('/images/config/'.$data->meta_value));
                    }
                }
            }
        
            $file = $value;
            $imageName = time().$file->getClientOriginalName();
            $upload = $file->move(public_path('images/config'), $imageName); 
            $value = $imageName;
        }
        if(!empty($data)){
            DB::table('config')->where('meta_key', $key)->update(['meta_value' => $value]);
        }else{
            DB::table('config')->where('meta_key', $key)->insert(['meta_key' => $key, 'meta_value' => $value]);
        }
        return '1';
    }

    public static function getJobTypes(){
        $types = ['freelance', 'full time', 'internship', 'part time', 'temporary'];
        return $types;
    }
}
