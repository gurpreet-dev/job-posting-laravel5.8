<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $guarded=[];
    
    public static function getSubscription($id){
        $user = User::with(['subscription_plan'])->find($id);
        if($user->subscribed == 1){
            return $user->subscription_plan->title;
        }else{
            return 'free';
        }
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function plan(){
        return $this->belongsTo('App\SubscriptionPlan', 'plan_id', 'id');
    }
}
