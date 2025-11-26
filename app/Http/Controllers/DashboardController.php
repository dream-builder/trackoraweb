<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //

    public function index(){


        $role_name = session('user_role')->role_name;

        //echo $role_name;

        $sql ="SELECT
                    (SELECT COUNT(*) FROM bus) AS bus_count,
                    (SELECT COUNT(*) FROM bus_routes) AS route_count;";
        $result = DB::select($sql);


        try{

            $sql = "select DISTINCT ON (ss.student_id) ss.student_id, s.first_name || s.last_name as name,
                    s.gender, ss.status, ss.created_at status_time
                    from student_status ss

                    left join students s on s.id = ss. student_id

                    ORDER BY ss.student_id, ss.created_at DESC;";

            $student_status = DB::select($sql);

        }catch(Exception $e){

        }


        if($role_name=='Admin'){
            // var_dump(session('user_role'));
            return view('dashboard', ['card_data' => $result[0], 'student_status' => $student_status]);
        }
        elseif($role_name=='Student'){
            return redirect()->route('live.student');
        }


    }
}
