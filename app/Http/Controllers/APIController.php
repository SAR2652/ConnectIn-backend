<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UserData;
use App\Pack;
use App\SavedPacks;
use App\TournamentForPack;

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
            //generate password for both Google and Facebook
            //login methods
            $count = UserData::where('social_login_type', $request->social_login_type)->count();
            $count++;
            $count = (string)$count;
            if($request->social_login_type = 'g')
            {
                $count = "google".$count; 
            }           
            else
            {
                $count = "facebook".$count; 
            }
            $post->password = md5($count);

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

    //creates a pack for the user
    public function createUserPack(Request $request)
    {
        $email = $request->email;     
        $response = json_decode(UserData::select('id')->where('email_address',$email)->get(), true);
        
        $post = new Pack;    
        $post->user_id = $response[0]["id"];
        $post->amount = $request->amount;
        $post->pack_markup = $request->markup;
        $post->pack_name = $request->pack_name;
        $post->ip_address = $request->ip_address;
        $post->save();
        
        return "Saved";
    }

    //retrieves details of bookmarked packs
    public function getSavedUserPacks(Request $request)
    {
        $email = $request->$email;
        $user_id = json_decode(UserData::select('id')->where('email_address',$email)->get(), true);

        $response = SavedPacks::select('*')->where('user_id', $user_id[0]["id"]); 
    }

    //returns details of user's currently present packs
    public function getUserPackDetails(Request $request)
    {
        $email = $request->email;
        $user_id = json_decode(UserData::select('id')->where('email_address',$email)->get(), true);

        $response = json_decode(Pack::select('id','amount', 'amount_hold', 'amount_sold', 'max_stake', 'pack_name', 'pack_active', 'pack_markup', 'pack_percentage', 'expiry_date')->where('user_id', $user_id[0]["id"])->get(), true);

        return $response;
    }

    //used by user to register a pack for a tournament
    public function registerPackForTournament(Request $request)
    {
        //create function to get tournament id from tournament name
        //when we get tournament entity table
    }

    //returns details of the tournament for the user
    public function getPackTournamentDetails(Request $request)
    {
        return TournamentForPack::select('*')->where('pack_id', $request->pack_id)->get();
    }
}
