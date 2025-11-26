<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthHelper
{
    public static function onSuccessfulLogin()
    {
        $user_id = Auth::user()->id;
        $sql ="Select r.role_name, r.id role_id, urm.user_id from user_role_map urm
	        left join roles r on r.id = urm.role_id
            where urm.user_id= " . $user_id;

        $result = DB::select($sql);

        if(count($result)>0){

            Session::put('user_role',$result[0]);
        }
       else{
        $roles =  [
                    'role_name' => 'Viewer',
                    'role_id'   => 5,
                    'user_id'   => $user_id,
                ];

        Session::put('user_role',(object) $roles);
       }

        //Session::put('user_role', auth()->user()->name); //$user->role->name ?? 'guest'

        // $user->last_login_at = now();
        // $user->save();

        // \Log::info("User {$user->email} logged in.");
    }
}
