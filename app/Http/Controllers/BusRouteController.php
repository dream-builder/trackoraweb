<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BusRouteController extends Controller
{
    public function index(){

        $sql = "select * from bus_routes order by route_name asc";

        $result = DB::select($sql);

        return view('routes.new',['route_name'=>$result]);
    }


    public function save_route(Request $request){

        //var_dump($request->input());

        $old_route_name = $request->input('old_route_name');
        $new_route_name = $request->input('new_route_name');

        if( empty($new_route_name) || strlen($new_route_name)<1){
            $route_name = $old_route_name;
        }else{
            $route_name = $new_route_name;
        }

        try{

            //echo json_encode($request->input('source_latlng'));

            DB::table('bus_routes')->upsert(
                [
                    [
                        'route_name' => $route_name,
                        'route_source' => $request->input('source'),
                        'route_destination' => $request->input('destination'),
                        'source_latlng' => json_encode($request->input('source_latlng')),
                        'destination_latlng' => json_encode($request->input('destination_latlng')),
                        'route_waypoints' => json_encode($request->input('way')),
                    ]
                ],
                ['route_name'], // Unique constraint
                ['route_source','route_destination','route_waypoints','source_latlng','destination_latlng'] // Columns to update on conflict

            );

            return response()->json([
                'status' => 'success',
                'message' => 'Route save successfully!'
            ]);
        }catch (\Exception $e) {
            // Optional: log the error
            Log::error('Bus route upsert failed: ' . $e->getMessage());

            // Show or return the error
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save route information: ' . $e->getMessage()
            ], 500);
        }

    }

    public function load_route(Request $request){


        $sql = "select * from bus_routes where route_name = '" . $request->input('route_name') ."'";

         try{
            $result = DB::select($sql);

            return response()->json([
                'status' => 'success',
                'data' => json_encode($result)
            ]);
        }catch (\Exception $e) {
            // Optional: log the error
            Log::error('Bus route upsert failed: ' . $e->getMessage());

            // Show or return the error
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save route information: ' . $e->getMessage()
            ], 500);
        }

    }

    public function get_students_on_route(Request $request){

        $route_id = $request->json('route_id');

        $sql = "select s.id student_id, s.first_name || ' ' || s.last_name as name, pickup_point, 'Active' as status from student_route_map srm
                left join students s on s.id = srm.student_id
                where s.id is not null and srm.route_id = " .$route_id;

        $students = DB::select($sql);

       return $students;

    }


    public function list(){
        $sql = "SELECT * FROM route_list_with_student_and_driver";
        $routes = DB::select($sql);

        return view('routes.list',['routes'=>$routes]);
    }


     public function view(Request $request){
        $sql = "SELECT * FROM route_list_with_student_and_driver where id=" .$request->input('route_id');
        $routes = DB::select($sql);

        $sql ="select s.id student_id, s.first_name || ' ' || s.last_name as student_name, s.gender, s.phone_number, s.email from student_route_map srm
	           left join students s on s.id = srm.student_id
               where srm.route_id=".$request->input('route_id');

        $students = DB::select($sql);


         $sql ="select d.id driver_id, d.name, d.phone, d.license_no, d.license_type from driver_route_map drm
                left join drivers d on d.id = drm.driver_id
                where drm.route_id=".$request->input('route_id');

        $drivers = DB::select($sql);

       // echo $sql;

        return view('routes.view',['routes'=>$routes,'students'=>$students, 'drivers'=>$drivers]);
    }


    public function delete(Request $request){

        try{
            DB::delete("DELETE FROM bus_routes WHERE id = ?", [$request->input('route_id')]);
             return response()->json([
                'status' => 'success',
                'message' => 'Deleted!", "Route has been removed'
            ]);
        }catch (\Exception $e) {

            // Show or return the error
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete route information: ' . $e->getMessage()
            ], 500);
        }




    }
}
