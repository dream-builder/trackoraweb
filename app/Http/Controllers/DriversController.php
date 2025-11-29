<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DriversController extends Controller
{
     public function index(){
        $sql = "select d.id, d.name,d.gender, d.phone, d.license_no, DATE_PART('year', AGE(d.dob::timestamp)) AS age, b.id as bus_id, b.bus_name  from drivers d
                left join driver_vehicle_map dvm on dvm.driver_id= d.id
                left join bus b on b.id = dvm.vehicle_id order by d.created_at desc";

       $drivers = DB::select($sql);

       $sql = "select * from bus";
       $buses = DB::select($sql);

        return view('driver.list',['drivers'=>$drivers, 'buses'=>$buses]);
    }

    public function addnewbus()  {

        $sql = "select * from bus_routes";
        $bus_routes = DB::select($sql);

        $sql = "select * from drivers";
        $bus_drivers = DB::select($sql);

        return view('driver.addnew',['bus_routes'=>$bus_routes, 'drivers'=> $bus_drivers]);
    }

    public function save(Request $request){


         // Check if the registration number already exists
            $exists = DB::table('users')
                ->where('email', $request->input('email'))
                ->exists();

            if($exists){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email address "'. $request->input('email') .'" is already reigstered.'
                ]);
            }
            else{
                try{

                    $license = $request->input('license_no');

                    // Check if the registration number already exists
                    $exists = DB::table('drivers')
                        ->where('license_no', $license)
                        ->exists();

                    if (!$exists) {
                    $driver_id = DB::table('drivers')->insertGetId([
                            'license_no'    => $request->input('license_no'),
                            'license_type'    => $request->input('license_type'),
                            'name'   => $request->input('driver_name'),
                            'dob' => $request->input('dob'),
                            'gender' => $request->input('gender'),
                            'phone'       => $request->input('phone_number'),
                            'email' => $request->input('email'),
                            'address'=> $request->input('address'),
                            'created_at'   => now()
                        ]);


                        //Create user for driver
                        $user = User::create([
                            'name'     => $request->input('driver_name'),
                            'email'    => $request->input('email'),  // or username
                            'password' => Hash::make('123456'),
                        ]);


                        //Just created user id
                        $userId = $user->id;


                        //User driver Map
                        $usm_id = DB::table('driver_user_map')->insertGetId([
                            'driver_id'   => $driver_id,
                            'user_id'    => $userId
                        ]);

                        //User Role Map
                        $urm_id = DB::table('user_role_map')->insertGetId([
                            'user_id'   => $userId,
                            'role_id'    => 4 //Driver
                        ]);


                        //User Route Map
                        $urm_id = DB::table('driver_route_map')->insertGetId([
                            'driver_id'   => $driver_id,
                            'route_id'    => $request->input('route', 0) //if set elase 0
                        ]);

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Information save successfully!'
                        ]);
                    }
                    else{
                        return response()->json([
                        'status' => 'error',
                        'message' => 'The driver with license number : ' . $license ." is already registered!"
                    ], 500);
                    }
                }catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to save information: ' . $e->getMessage()
                    ], 500);
                }
            }


    }

    public function assignvehicle(Request $request){

            try{


                DB::table('driver_vehicle_map')->insert([
                    'driver_id'    => $request->input('driver_id'),
                    'vehicle_id'    => $request->input('bus_id'),
                    'created_at'   => now()
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Information save successfully!'
                ]);

            }catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to save information: ' . $e->getMessage()
                ], 500);
            }

    }

     public function dashboard(){

        //Dashboard panel
        $sql = "select
                    count(*) as bus_count
                    from driver_vehicle_map dvm
                    where dvm.driver_id = 1";

        $assigned_bus = DB::select($sql);




        $sql = "select d.id driver_id, b.id bus_id, b.bus_name, b.bus_registration_number, b.route_name, b.bus_route,

                    (
                        SELECT COUNT(*)
                        FROM student_bus_map
                        WHERE bus_id = dvm.vehicle_id
                    ) AS student_count

                    from driver_vehicle_map dvm
                    left join drivers d on d.id = dvm.driver_id
                    left join bus b on b.id = dvm.vehicle_id

                    where d.id = 1";

       $buses = DB::select($sql);

        return view('driver.dashboard',['buses'=>$buses, 'assigned_bus'=>$assigned_bus]);
    }

    public function starttravel(Request $request) {

        $sql = "select s.id, s.first_name ||' ' || s.last_name as full_name, s.gender, s.phone_number from student_bus_map sbm
	            left join students s on s.id = sbm.student_id
                where bus_id = " . $request->get('bus_id');

        $students_on_bus = DB::select($sql);

        return view('driver.travel',['students_on_bus'=>$students_on_bus]);
    }


    public function addnewdriver()  {

        $sql = "select * from bus_routes";
        $bus_routes = DB::select($sql);

        $sql = "select * from drivers";
        $bus_drivers = DB::select($sql);

        return view('driver.addnew',['bus_routes'=>$bus_routes, 'drivers'=> $bus_drivers]);
    }
}
