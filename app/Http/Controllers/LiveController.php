<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\JsonStorageService;

class LiveController extends Controller
{

    protected $jsonService;

    public function __construct(JsonStorageService $jsonService)
    {

        $this->jsonService = $jsonService;
    }

    public function index(){

       //$this->store();

    //    $data =$this->show();
    //    var_dump($this->jsonService->get('users1'));

        $routes = DB::select("select * from bus_routes");

        return view('live.liveroute', ['routes'=>$routes]);
    }

    public function store()
    {
        $this->jsonService->set('user1', ['name' => 'Alice', 'age' => 25]);
        $this->jsonService->set('user1', ['name' => 'Shahed', 'age' => 25]);
       // return response()->json(['status' => 'saved']);
    }

    public function show()
    {
        $data = $this->jsonService->get('user1');
        return response()->json($data);
    }

    public function live_student(){

        $sql = "select s.id student_id, s.first_name || s.last_name student_name, s.gender,
                    s.phone_number, b.id bus_id, b.bus_name, b.bus_registration_number,
					br.route_name,br.route_waypoints, br.route_source, br.route_destination,
					d.id driver_id, d.name driver_name, d.phone driver_phone, d.email driver_email, d.license_no driver_license, d.license_type

				from students s
                left join user_student_map usm on usm.student_id = s.id
				left join student_bus_map sbm on sbm.student_id = s.id
                left join bus b on b.id = sbm.bus_id
                left join bus_routes br on br.id = sbm.route_id
				left join driver_vehicle_map dvm on dvm.vehicle_id = b.id
				left join drivers d on d.id = dvm.driver_id

                where usm.user_id = " . auth()->user()->id;

                //echo $sql;

        try{
            $result = DB::select($sql);
        }catch(Exception $e){

        }

        $data = $this->jsonService->get('std'.auth()->user()->id);
        //var_dump($data);

        return view('live.student_live',['data'=> $result]);
    }

    public function get_bus_and_student_location(Request $request){
        $data =[];
        array_push($data,[$request->query('student_id') => $this->jsonService->get($request->query('student_id'))]);
        array_push( $data, [$request->query('bus_id')=>$this->jsonService->get($request->query('bus_id'))]);

        return response()->json($data);
    }


    public function update_bus_demo(){
        return view('demo.bus');
    }
}
