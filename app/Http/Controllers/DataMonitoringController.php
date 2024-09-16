<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\StatusConnection;
use Illuminate\Support\Facades\DB;

class DataMonitoringController extends Controller
{
    public function insertData(Request $request){
        DB::table('data_monitoring')->insert([
            'user_id' => 1,
            'driver_status' => $request->status_mengantuk == true ? 'mengantuk' : 'tidak mengantuk',
            'tombol_status' => $request->button_status == true ? 'ditekan' : 'tidak ditekan',
            'created_at' => Carbon::now(),
        ]);
    }

    public function connection(Request $request){
        
        $driver = User::find($request->user_id);

        $data = [
            'driver' => ($driver->first_name ?? '') . ' ' . ($driver->last_name ?? ''),
            'status_connection' => $request->status_connection ?? null,
            'ip_address' => $request->ip_address ?? null,
            'ssid' => $request->ssid ?? null
        ];

        return event(new StatusConnection($data));
    }

    public function gpsdata(){
        return DB::table('data_monitoring')->insert(
            ['user_id' => 1,
            'latitude' => $request->latitude ?? null,
            'longitude' => $request->longitude ?? null, 
            'created_at' => Carbon::now()]
        );
    }
}
