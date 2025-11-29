<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(){

        $sql = "Select id, route_name from bus_routes";
        $result = DB::select($sql);


        return view('student.student', ['routes'=> $result]);
    }


    public function add_new(Request $request) {

        //Checking Exist email
         $exists = DB::table('users')
            ->where('email', $request->input('email'))
            ->exists();

            if($exists){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Student slready registerd.'
                    ]);
            }
            else{
                 try{
                    //Create new Student
                    $student_id = DB::table('students')->insertGetId([
                        'first_name'   => $request->input('first_name'),
                        'last_name'    => $request->input('last_name'),
                        'gender'       => $request->input('gender'),
                        'date_of_birth'=> $request->input('dob'),
                        'email'        => $request->input('email'),
                        'phone_number' => $request->input('phone_number'),
                        'address'      => $request->input('address'),
                        'class'        => $request->input('class'),
                        'roll_number'  => $request->input('roll_number'),
                        'pickup_point' => $request->input('pickup_location'),
                        'created_at'   => now()
                    ]);

                    //Create user for sutdent
                    $user = User::create([
                        'name'     => $request->input('first_name') ." ". $request->input('last_name'),
                        'email'    => $request->input('email'),  // or username
                        'password' => Hash::make('123456'),
                    ]);


                    //Just created user id
                    $userId = $user->id;


                    //User Student Map
                    $usm_id = DB::table('user_student_map')->insertGetId([
                        'student_id'   => $student_id,
                        'user_id'    => $userId
                    ]);

                    //User Role Map
                    $urm_id = DB::table('user_role_map')->insertGetId([
                        'user_id'   => $userId,
                        'role_id'    => 2 //Student
                    ]);


                    //student route map
                    $srm_id = DB::table('student_route_map')->insertGetId([
                    'student_id'   =>  $student_id,
                    'route_id'    => $request->input('route')
                    ]);



                    return response()->json([
                        'status' => 'success',
                        'message' => 'Student inserted successfully!' . $student_id
                    ]);
                }catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to insert student: ' . $e->getMessage()
                    ], 500);
                }
            }



    }


    public function showall(){

        $sql = "select * from students";

        $result = DB::select($sql);

        return view('student.show',['students'=>$result]);
    }


    public function get_student_route_info(Request $request){

        $route_id= $request->input('bus_id');

        try{
            $sql = "select s.id student_id,  s.first_name|| ' ' || s.last_name as student_name,
                        b.id bus_id, b.bus_name, br.id route_id
                        from student_bus_map sbm
                        left join students s on s.id = sbm.student_id
                        left join bus b on b.id = sbm.bus_id
                        left join bus_routes br on br.id = sbm.route_id where sbm.bus_id = ".$route_id;
            $result= (DB::select($sql));

            return $result;

        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get studetn info: ' . $e->getMessage()
            ], 500);
        }
    }

    public function load_students_of_this_route_by_route_id(Request $request){

        $result= $request->query('route_id');

       //var_dump($result);


        try{
            $sql = "select s.id student_id,  s.first_name|| ' ' || s.last_name as student_name, s.gender,
                        b.id bus_id, b.bus_name, br.id route_id
                        from student_bus_map sbm
                        left join students s on s.id = sbm.student_id
                        left join bus b on b.id = sbm.bus_id
                        left join bus_routes br on br.id = sbm.route_id
						where br.id = ".$result;
            $result= (DB::select($sql));

            return response()->json($result) ;

        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get student info of this route id : '. $result . $e->getMessage()
            ], 500);
        }
    }


    public function registertoroute(){
        $sql = "select id route_id, route_name from bus_routes  ";

        $routes = DB::select($sql);

        return view('routes.addtoroute',['routes'=>$routes]);
    }

}
