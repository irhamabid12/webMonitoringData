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
        // Simpan data ke database
        DB::table('data_monitoring')->insert([
            'user_id' => 1,
            'latitude' => $request->latitude ?? null,
            'longitude' => $request->longitude ?? null,
            'speed' => $request->speed ?? null,
            'driver_status' => $request->status_mengantuk ?? null,
            'tombol_status' => $request->button_status ?? null,
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

        // Broadcast event untuk update status connection
        return event(new StatusConnection($data));
    }

    public function gpsdata(){
        // Simpan latitude dan longitude ke dalam session
        Session::put('latitude', $request->latitude ?? null);
        Session::put('longitude', $request->longitude ?? null);
    }
}
