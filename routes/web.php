<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // echo xdebug_info();
    echo phpinfo();
    return view('welcome');
});

route::get('setmysql', [TestController::class, 'setmysql']);
route::get('setpostgres', [TestController::class, 'setpostgres']);
route::get('setredis', [TestController::class, 'setredis']);
route::get('getmysql', [TestController::class, 'getmysql']);
route::get('getpostgres', [TestController::class, 'getpostgres']);
route::get('getredis', [TestController::class, 'getredis']);

Route::get('test', function () {
   $x=1;
   $y=2;

   $x+=$y;
   echo $x;
});
