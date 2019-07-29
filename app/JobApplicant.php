<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class JobApplicant extends Model
{
    protected $table = 'job_applicants';
    protected $guarded=[];

    public function job(){
        return $this->belongsTo('App\Job', 'job_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public static function hiredUsers($job_id){
        $applicants = JobApplicant::where(['job_id' => $job_id, 'status' => 1])->count();
        return $applicants;
    }

}
