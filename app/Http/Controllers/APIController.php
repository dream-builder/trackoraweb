<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



// class user{
//     public $id;
//     public $name;
//     public $role;
//     public $token;
//     public $phone;
//     public $email;
//     public $address;
//     public $grade;

// }

class APIController extends Controller
{
    //

    public $user ;


    function get_student_detail($user_id){

        //get User role
        $sql = "select  s.first_name || ' ' || s.last_name as name,
                    s.gender, s.date_of_birth dob, s.email, s.phone_number, s.address, s.class, s.roll_number,
                    s.pickup_point from students s
                    left join user_student_map usm on usm.student_id = s.id
                    where usm.user_id =" . $user_id;

        try{
          return  $result = DB::select($sql);

        }catch(Exception $e){

        }
    }

    function get_driver_detail($user_id){

        //get User role
        $sql = "select d.id user_id, d.name, d.gender, d.email, d.phone, d.address, d.license_no, d.license_type, 'driver' AS role
	                from drivers d
	                left join driver_user_map udm on udm.driver_id = d.id
                    where udm.user_id =" . $user_id;

        try{
          return  $result = DB::select($sql);

        }catch(Exception $e){

        }
    }


    function get_user_detail($user_id){

        //get User role
        $sql = "select u.id user_id, usm.student_id, drm.driver_id, u.name, u.email, r.id role_id, LOWER(r.role_name) role_name from users u
                left join user_role_map urm on urm.user_id = u.id
                left join roles r on r.id = urm.role_id
                left join user_student_map usm on usm.user_id = u.id
                left join driver_user_map drm on drm.user_id = u.id
                where u.id = " . $user_id;

        //echo $sql;

        try{
            $result = DB::select($sql);
            $this->user['user_id'] =$user_id;
            $this->user['name']=$result[0]->name;
            $this->user['email']=$result[0]->email;
            $this->user['student_id']=$result[0]->student_id;
            $this->user['driver_id']=$result[0]->driver_id;
            $this->user['role_id']=$result[0]->role_id;
            $this->user['role']=$result[0]->role_name;

        }catch(Exception $e){

        }

        //get Studnet profile

        if($this->user['role']=='Admin'){

            $student =  $this->get_student_detail($user_id);

            $student=$student[0];

           return $student;
        }

        //If user is Driver
        if($this->user['role']=='Driver'){

            $driver =  $this->get_driver_detail($user_id);

            $driver=$driver[0];

           return $driver;
        }



        //If there is no role matched just return the user detail
        return $this->user;

    }


    public function login(Request $request){
        $credentials = $request->only('email', 'password');


    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = 000; //$user->createToken('flutterApp')->plainTextToken; // Sanctum/Passport


        //get User detail
        $data= $this->get_user_detail(Auth::user()->id);

        //return response()->json($data);
        //get User role
        $role = $this->get_user_role(Auth::user()->id);


        return response()->json([
            'status' => true,
            'token' => $token,
            'role' => $role,
            'user' =>  $data
        ]);
    }

    return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
    }


    public function get_route(Request $request){

        //get User role
        // $sql = "select b.id bus_id,b.bus_name, b.bus_registration_number, dvm.driver_id, d.name driver_name, d.phone driver_phone, br.id route_id, br.route_name, br.route_source, br.route_destination, br.route_waypoints, br.source_latlng, br.destination_latlng from bus_routes br
        //         left join bus b on b.bus_route::integer = br.id
        //         left join student_bus_map sbm on sbm.bus_id = b.id
		// 		left join driver_vehicle_map dvm on dvm.vehicle_id = bus_id
		// 		left join drivers d on d.id = dvm.driver_id
        //         where sbm.student_id = " . $request->get('id');

         $sql = "select * from get_route_by_student where student_id = " .    $request->get('id');
        try{
            $result = DB::select($sql);

            return response()->json([
                'status' => true,
                'data' =>  $result
            ]);

        }catch(Exception $e){

            response()->json([
            'status' => false,
            'code' => 500,
            'error' =>  $e
        ]);
        }

    }

    function get_user_role($user_id){
         //get User role
        $sql = "select u.name, u.email, r.role_name, r.id from users u
                left join user_role_map urm on urm.user_id = u.id
                left join roles r on r.id = urm.role_id
                where u.id = " . $user_id;

        //echo $sql;

        try{
            $result = DB::select($sql);

            if(isset($result[0]) && isset($result[0]->role_name))
                $role = strtolower( $result[0]->role_name);
            else
                $role ="";
            return $role;

        }catch(Exception $e){

        }
    }

    function get_route_by_driver_id(Request $request){

        $sql = "select br.id route_id, br.route_name, b.id bus_id, b.bus_name from bus_routes br
                left join bus b on b.bus_route::integer = br.id
                left join driver_vehicle_map dvm on dvm.vehicle_id = b.id
                where dvm.driver_id = " .  $request->get('id');

        try{
            $result = DB::select($sql);

            return $result;

        }catch(Exception $e){

        }
    }


        public function get_route_by_id(Request $request){

        //get User role
        $sql = "select * from bus_routes where id = " . $request->get('id');

        try{
            $result = DB::select($sql);

            return response()->json([
                'status' => true,
                'data' =>  $result
            ]);

        }catch(Exception $e){

            response()->json([
            'status' => false,
            'code' => 500,
            'error' =>  $e
        ]);
        }

    }


    function get_student_by_route_id(Request $request){

       // var_dump($request->get('route_id'));

        $sql = "select s.id student_id, s.first_name || ' ' || s.last_name as name, pickup_point, 'Active' as status from student_route_map srm
                left join students s on s.id = srm.student_id
                where s.id is not null and srm.route_id = " . $request->get('route_id');

        try{
            $result = DB::select($sql);
           return $result;

        }catch(Exception $e){
            response()->json([
            'status' => false,
            'code' => 500,
            'error' =>  $e
        ]);
        }


    }

    function update_student_status(Request $request){


        if($request->has('student_id')){
            try{
                DB::table('student_status')->insert([
                    'student_id' => $request->get('student_id'),
                    'status'     => $request->get('status'),
                    'created_at' => now(),

                ]);


                response()->json([
                            'status' => true,
                            'code' => 200,
                        ]);

            }catch(Exception $e){
                response()->json([
                            'status' => false,
                            'code' => 500,
                            'error' =>  $e
                        ]);
            }
        }
        else{
           echo "No data sent to servert";
        }





    }

}
