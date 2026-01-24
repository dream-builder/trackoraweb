<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusController extends Controller
{
    public function index(){
        $sql = "select b.id, b.bus_registration_number , b.bus_name, br.route_name, b.bus_owner,
	            b.bus_route from bus b
                left join bus_routes br on br.id = b.bus_route::integer";

        $result = DB::select($sql);

        return view('bus.list',['buses'=>$result]);
    }

    public function addnewbus()  {

        $sql = "select * from bus_routes";
        $bus_routes = DB::select($sql);

        $sql = "select * from drivers";
        $bus_drivers = DB::select($sql);

        return view('bus.addnew',['bus_routes'=>$bus_routes, 'drivers'=> $bus_drivers]);
    }

    public function save(Request $request){
        try{

            $registrationNumber = $request->input('registration_no');

            // Check if the registration number already exists
            $exists = DB::table('bus')
                ->where('bus_registration_number', $registrationNumber)
                ->exists();

            if (!$exists) {
                DB::table('bus')->insert([
                    'bus_name'   => $request->input('bus_name'),
                    'bus_registration_number'    => $request->input('registration_no'),
                    // 'bus_route'       => $request->input('route'),
                    'route_name' => "",
                    'bus_owner'=> $request->input('owner'),
                    'created_at'   => now()
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Information save successfully!'
                ]);
            }
            else{
                return response()->json([
                'status' => 'error',
                'message' => 'The bus with registration number : ' . $registrationNumber ." is already registered!"
            ], 500);
            }
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save information: ' . $e->getMessage()
            ], 500);
        }
    }

    public function addtobus(){

        $sql = "select b.id, b.bus_name, b.bus_route, r.route_name from bus b
                left join bus_routes r on r.id = b.bus_route::integer ";
        $buses = DB::select($sql);

        return view('bus.addtobus',['buses'=>$buses]);

    }


    public function get_available_students(Request $request){

        $sql = "select s.id, s.first_name ||' ' || s.last_name as name from students s ";
        $students = DB::select($sql);

        return $students;

    }

     public function get_students_on_bus(Request $request){

        $bus_id = $request->json('bus_id');

        $sql = "select s.id, s.first_name ||' ' || s.last_name as name from student_route_map sbm
                    left join students s on s.id = sbm.student_id
                    where sbm.route_id = " .$bus_id;

        $students = DB::select($sql);

       return $students;

    }


    public function register_student_on_bus(Request $request){

        $student_id = $request->json('students');
        $bus_id = $request->json('bus_id');

      //  var_dump($student_id);
      //  var_dump($bus_id);

        try{

                foreach($student_id as $id){
                    DB::table('student_route_map')->insert([
                    'route_id'   => $bus_id,
                    'student_id' => $id,
                    'created_at'   => now()
                ]);

                }

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

}
