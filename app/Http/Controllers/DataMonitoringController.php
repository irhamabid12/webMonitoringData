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
            'driver_status' => 'mengantuk',
            'tombol_status' => $request->status ?? null,
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
}
