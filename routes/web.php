<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LocationManager;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusRouteController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\LiveController;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/live', [LiveController::class, 'index'])->name('live.show');
    Route::get('/live_student', [LiveController::class, 'live_student'])->name('live.student');
    Route::get('/get_bus_and_student_location', [LiveController::class, 'get_bus_and_student_location'])->name('live.getstudentandbus');
    Route::get('/update_bus_demo', [LiveController::class, 'update_bus_demo'])->name('live.update_bus_demo');
});

//Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');




Route::get('/student', [StudentController::class, 'index'])->name('student.create');
Route::post('/student/add_new', [StudentController::class, 'add_new'])->name('student.save');
Route::get('/showallstudents', [StudentController::class, 'showall'])->name('student.show');
Route::get('/registertoroute', [StudentController::class, 'registertoroute'])->name('student.registertoroute');

Route::get('/bus', [BusController::class, 'index'])->name('bus.show');
Route::get('/addnewbus', [BusController::class, 'addnewbus'])->name('bus.addnew');
Route::post('/bus/save', [BusController::class, 'save']);
Route::get('/addtobus', [BusController::class, 'addtobus'])->name('bus.addtobus');
Route::post('/bus/get_available_students', [BusController::class, 'get_available_students']);
Route::post('/bus/get_students_on_bus', [BusController::class, 'get_students_on_bus']);
Route::post('/bus/register_student_on_bus', [BusController::class, 'register_student_on_bus']);



Route::get('/driverdashboard', [DriversController::class, 'dashboard'])->name('driver.dashboard');
Route::get('/starttravel', [DriversController::class, 'starttravel'])->name('driver.starttravel');
Route::get('/drivers', [DriversController::class, 'index'])->name('driver.show');
Route::get('/addnewdriver', [DriversController::class, 'addnewdriver'])->name('driver.addnew');
Route::post('/drivers/save', [DriversController::class, 'save']);
Route::post('/drivers/assignvehicle', [DriversController::class, 'assignvehicle'])->name('driver.assignvehicle');

Route::get('/routes', [BusRouteController::class, 'index'])->name('route.show');
Route::post('/saveroute', [BusRouteController::class, 'save_route'])->name('route.save');
Route::post('/loadroute', [BusRouteController::class, 'load_route'])->name('route.load');
Route::post('/route/get_students_on_route', [BusRouteController::class, 'get_students_on_route']);
Route::get('/routes/list', [BusRouteController::class, 'list'])->name('route.list');
Route::get('/routes/view', [BusRouteController::class, 'view'])->name('route.view');
Route::post('/routes/delete', [BusRouteController::class, 'delete'])->name('route.delete');






#APIS
Route::get('/api/getlivelocation', [LocationManager::class, 'getlivelocation'])->name('locationmanager');
Route::get('/api/getlivelocationbyid', [LocationManager::class, 'getlivelocationbyid'])->name('api.get.location');
Route::get('/api/setlivelocation', [LocationManager::class, 'setlivelocation'])->name('api.get.location');
//Route::get('/api/setlivelocation', [LocationManager::class, 'savelocation'])->name('locationmanager.setlocation');
Route::get('/api/getstudentlocationstatus', [StudentController::class,'get_student_route_info'])->name('api.student.getlocation');
Route::get('/api/load_students_of_this_route_by_route_id', [StudentController::class,'load_students_of_this_route_by_route_id'])->name('api.load_students_of_this_route_by_route_id');


//Route::post('/api/getlivelocation', [LocationManager, 'getlivelocation'])->name('location.live.get');

Route::get('/token',function(){
    return  csrf_token();
});

Route::post('api/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = 12345678; //$user->createToken('flutterApp')->plainTextToken; // Sanctum/Passport
        return response()->json([
            'status' => true,
            'token' => $token,
            'user' => $user
        ]);
    }

    return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
});


Route::get('api/login', [APIController::class, 'login']);

// Route::get('api/livemaploc', function(Request $request){
//     echo json_encode(['latitude' => 23.765086336538264, 'longitude' => 90.41226876553883, 'user_id'=> $request->get('user_id'), 'driver_id'=>$request->get('driver_id')]);
// });

//Test API save User location by user id


Route::get('api/livemaploc', [LocationManager::class, 'get_location_by_user_id']);
Route::get('/api/saveuserlocation', [LocationManager::class, 'savelocation_by_user']);
Route::get('/api/get_route_by_student_id', [APIController::class, 'get_route']);
Route::get('/api/get_route_by_driver_id', [APIController::class, 'get_route_by_driver_id']);
Route::get('/api/get_route_by_id', [APIController::class, 'get_route_by_id']);
Route::get('/api/get_student_by_route_id', [APIController::class, 'get_student_by_route_id']);
Route::get('/api/update_student_status', [APIController::class, 'update_student_status']);


















// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';


Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn', 'ar'])) {
        session(['locale' => $locale]);
    }
    return back();
});

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|bn|es'], 'middleware' => 'web'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/about', [DashboardController::class, 'index'])->name('about');
});

Route::get('/', function () {
    return redirect(app()->getLocale() ?: config('locales.default'));
});

// Language prefix group
Route::prefix('{locale}')->group(function () {
    Route::get('/', function ($locale) {
        session(['locale' => $locale]);
        return view('welcome');
    });
});

