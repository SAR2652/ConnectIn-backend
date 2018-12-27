<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UserData;

class APIController extends Controller
{
    public function socialLogin(Request $request)
    {
        $email = $request->email;
        $checkEmail = DB::table('tbl_users')->where('email_address', $email)->exists();

        if($checkEmail == true)
        {
            $response = DB::table('tbl_users')->select('*')->where('email_address', $email)->get();
            return $response;
        }
        else 
        {
            $post = new UserData;

            //generate password for
            //Google Sign in
            if($request->social_login_type = 'g')
            {
                $gsl_count = UserData::where('social_login_type','g')->count();
                $gsl_count++;
                $gsl_count = (string)$gsl_count;
                $gsl_count = "google".$gsl_count; 
                $post->password = md5($gsl_count);
            }
            else
            {
                $fsl_count = UserData::where('social_login_type','f')->count();
                $fsl_count++;
                $fsl_count = (string)$fsl_count;
                $fsl_count = "facebook".$fsl_count; 
                $post->password = md5($fsl_count);
            }

            $post->email_address = $email;
            $post->first_name = $request->first_name;
            $post->last_name = $request->last_name;
            $post->gender = "f";
            $post->status = "a";
            $post->email_verified = "y";
            $post->social_login_type = $request->social_login_type;
            $post->date_added = date("Y-m-d H:i:s");
            $post->date_updated = date("Y-m-d H:i:s");
            $post->profile_picture_name = "ganesha.jpg";
            $post->phone_no = "8169952740";
            $post->address_line1 = "";
            $post->address_line2 = "";
            $post->zipcode = "400101";
            $response = $post;
            $post->save();
            return $response;
        }
    }

    

    public function retrieveProfile(Request $request)
    {
        
    }
}
