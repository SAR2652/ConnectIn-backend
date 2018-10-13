<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use UserData;

class APIController extends Controller
{
    public function checkUserExistsandLogin(Request $request)
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
            $post->first_name = $request->first_name;
            $post->last_name = $request->last_name;
            $post->email_address = $request->email;
        }
    }
}
