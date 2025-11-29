<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JsonStorageService;


class LocationManager extends Controller
{
    protected $jsonService;

    public function __construct(JsonStorageService $jsonService)
    {
        $this->jsonService = $jsonService;
    }

    public function getlivelocation(){

        $file = 'data.json';

        // Check if file exists
        if (file_exists($file)) {
            // Read the file content
            $jsonData = file_get_contents($file);

            // Set content type to JSON and output the raw JSON text
            header('Content-Type: application/json');
            echo $jsonData;
        } else {
            // If file doesn't exist, return an error message in JSON format
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => "File not found"]);
        }

    }

    public function getlivelocationbyid(Request $request){
        return response()->json($this->jsonService->get($request->query('data')));
    }


    public function setlivelocation(Request $request){


        $input_data=$request->query();

        $this->jsonService->set($input_data['id'], $input_data);

        //$json_data=json_decode();

        //echo($json_data);

        return response()->json($this->jsonService->get($input_data['id']));
        //$this->jsonService->set('user1', ['name' => 'Shahed', 'age' => 25]);

    }

    public function savelocation(){
        // Set the file path
        $file = 'data.json';

        // Get the raw JSON data from the request body
        $inputData = file_get_contents("php://input");

        // Check if data is received
        if (!empty($inputData)) {
            // Open the file in WRITE mode ("w") - this replaces previous data
            file_put_contents($file, $inputData, LOCK_EX);

            // Send success response
            echo json_encode(["status" => "success", "message" => "Data stored successfully"]);
        } else {
            // Send error response
            echo json_encode(["status" => "error", "message" => "No data received"]);
        }
    }

    // THis function will save the Json value of Lat and Lng to teh specific file named by ind in loc dir

    //{"user_id":1,"driver_id":1, "latitude":29.809127, "longitude":20.30456}
    public function savelocation_by_user(Request $request){


        $data_json = json_decode($request->get('data'));

       //var_dump($data_json);

        // Set the file path
        $fileName =  $data_json->user_id .".json";

        // Using native PHP
        $file = fopen(storage_path('app/loc/' . $fileName), 'w'); // 'w' mode = write
        fwrite($file, json_encode( $data_json));
        fclose($file);

        return "File created and data written successfully!";
    }


    public function get_location_by_user_id(Request $request)
    {
         $data_json = json_decode($request->get('data'));

        // Set the file path
        $fileName = $request->get("user_id");  //$data_json->user_id .".json";
        $filePath = storage_path('app/loc/' . $fileName.".json");

        if (!file_exists($filePath)) {

            //create file
            $file = fopen(storage_path('app/loc/' . $fileName), 'w'); // 'w' mode = write
           // fwrite($file, json_encode( $data_json));
            fclose($file);

           // return "File does not exist.";
        }

        $content = file_get_contents($filePath);

        return $content;  // returns all file content
    }




    public function getrouteinfo(){
        return '
                {
        "route": {
            "route_number": "R101",
            "route_name": "Downtown Loop",
            "path": [
            { "lat": 40.712776, "lon": -74.005974 },
            { "lat": 40.713776, "lon": -74.004974 },
            { "lat": 40.714776, "lon": -74.003974 }
            ]
        },
        "bus": {
            "bus_id": "B1001",
            "registration_number": "XYZ-1234",
            "bus_name": "City Express"
        },
        "driver": {
            "driver_id": "D501",
            "name": "John Doe",
            "phone_number": "+1234567890",
            "assigned_bus_id": "B1001",
            "assigned_route_number": "R101"
        },
        "passengers": [
            {
            "passenger_id": "P001",
            "name": "Alice Smith",
            "geolocation": { "lat": 40.713001, "lon": -74.004000 }
            },
            {
            "passenger_id": "P002",
            "name": "Bob Johnson",
            "geolocation": { "lat": 40.714000, "lon": -74.003000 }
            }
        ]
        }'
        ;
    }

}
