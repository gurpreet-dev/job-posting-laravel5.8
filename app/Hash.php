<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Hash extends Model
{
    protected $guarded=[];

    public static function encode($data){
        $var = base64_encode($data);
        return $var;
    }

    public static function decode($data){
        $var = base64_decode($data);
        return $var;
    }

    public static function price($data){

        $currency = '$';
        $var = $currency.number_format($data, 2);
        return $var;
    }

    public static function image($path, $image){

        if($image != null || $image != ''){
            if(file_exists(public_path($path.$image))){
                $url = url($path.$image);
            }else{
                $url = url('/images/noimage.svg');
            }
        }else{
            $url = url('/images/noimage.svg');
        }
        
        return $url;
    }

    public static function userImage($path, $image){

        if($image != null || $image != ''){
            if(file_exists(public_path($path.$image))){
                $url = url($path.$image);
            }else{
                $url = url('/images/userimage.png');
            }
        }else{
            $url = url('/images/userimage.png');
        }
        
        return $url;
    }

}