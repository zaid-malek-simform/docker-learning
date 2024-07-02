<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function setmysql()
    {
        $data = \DB::connection('mysql')->table('testdatas')->insert(['name' => Carbon::now()]);
        if ($data) {
            echo 'Successfully inserted into mysql';
        }
    }

    public function setpostgres()
    {
        $data = \DB::connection('pgsql')->table('testdatas')->insert(['name' => Carbon::now()]);
        if ($data) {
            echo 'Successfully inserted into postgres';
        }
    }

    public function setredis()
    {
        $data = Redis::set('time', Carbon::now());
        if ($data) {
            echo 'Successfully inserted into redis';
        }
    }
    public function getmysql()
    {
        $data = \DB::connection('mysql')->table('testdatas')->get();
        dd($data->pluck('name')->toArray());
    }

    public function getpostgres()
    {
        $data = \DB::connection('pgsql')->table('testdatas')->get();
        dd($data->pluck('name')->toArray());
    }
    public function getredis()
    {
        $keys = Redis::keys('*');
        $data = array();
        foreach ($keys as $key) {
            $data[] = Redis::get(str_replace('laravel_database_', '', $key));
        }
        dd($data);
    }
}
