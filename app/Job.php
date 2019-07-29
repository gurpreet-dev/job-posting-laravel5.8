<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $guarded=[];

    public function applicants(){
        return $this->hasMany('App\JobApplicant', 'job_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function hiredUser(){
        return $this->belongsTo('App\User', 'hired_user', 'id');
    }

    public function isHired(){
        return $this->hasMany('App\JobApplicant', 'job_id', 'id');
    }

    public function hiredApplicants(){
        return $this->hasMany('App\JobApplicant', 'job_id', 'id');
    }

}
