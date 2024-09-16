<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function getRiwayatHarian(Request $request)
    {   
        $year = $request->year ?? date('Y');  // Gunakan tahun yang diberikan, atau tahun sekarang
        $month = $request->month ?? date('m');             // Bulan yang dipilih
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); // Dapatkan jumlah hari
        
        $getDetailData = DB::table('data_monitoring')
                        ->where('user_id', auth()->user()->id)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->select('driver_status','tombol_status','created_at')
                        ->get();
            
        $dataharian = DB::table('data_monitoring')
                    ->where('user_id', auth()->user()->id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->select(DB::raw('DAY(created_at) as label'), DB::raw('COUNT(*) as data'))  // Kelompokkan berdasarkan jam
                    ->groupBy('label')
                    ->get();

        $labels = range(1, $daysInMonth);  // Daftar hari lengkap dalam bulan tersebut
        $data = array_fill(0, $daysInMonth, 0);  // Inisialisasi data dengan 0 untuk setiap hari
        
        // Isi array $data berdasarkan hasil query
        foreach ($dataharian as $item) {
            $day = (int) $item->label;  // Ambil hari dari hasil query
            $data[$day - 1] = $item->data;  // Set data sesuai dengan hari yang ada
        }

        // Hitung rata-rata hanya untuk hari yang memiliki data
        $totalData = array_sum($data);            // Jumlah total aktivitas
        $nonZeroDays = count(array_filter($data)); // Hitung jumlah hari yang memiliki data (tidak nol)
        $average = $nonZeroDays > 0 ? $totalData / $nonZeroDays : 0; // Rata-rata hanya untuk hari yang memiliki data
        
        // Hitung rata-rata ketika tombol ditekan
        $queryTekan = DB::table('data_monitoring')
                    ->where('user_id', auth()->user()->id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->where('tombol_status', 'ditekan')
                    ->select(DB::raw('COUNT(*) as jumlah'))
                    ->first();

        // Hitung rata-rata ketika tombol tidak ditekan
        $queryTidakTekan = DB::table('data_monitoring')
                    ->where('user_id', auth()->user()->id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->where('tombol_status', 'tidak ditekan')
                    ->select(DB::raw('COUNT(*) as jumlah'))
                    ->first();

        $result = [
            'data'  => $data,
            'labels' => $labels,
            'detail' => $getDetailData ?? null,
            'average' => round($average, 2),  // Rata-rata$average
            'tekan' => $queryTekan->jumlah,
            'tidaktekan' => $queryTidakTekan->jumlah
        ];
        
        return response()->json($result);
    }

    public function getRiwayatBulanan(Request $request)
    {
        $year = $request->year ?? date('Y');  // Gunakan tahun yang diberikan, atau tahun sekarang
        $getDetailData = DB::table('data_monitoring')
            ->where('user_id', auth()->user()->id)
            ->whereYear('created_at', $year)
            ->select(
                        'driver_status',
                        'tombol_status',
                        'created_at'
                    )
            ->get();

        // Ambil data dari tabel data_monitoring, dikelompokkan berdasarkan bulan
        $queryResult = DB::table('data_monitoring')
            ->where('user_id', auth()->user()->id)
            ->whereYear('created_at', $year)
            ->select(DB::raw('MONTH(created_at) as label'), DB::raw('COUNT(*) as data'))  // Kelompokkan berdasarkan bulan
            ->groupBy('label')
            ->get(); 
        
        // Inisialisasi label dan data untuk 12 bulan
        $labels = range(1, 12);
        $data = array_fill(0, 12, 0);
        
        // Isi array data berdasarkan hasil query
        foreach ($queryResult as $item) {
            $month = (int) $item->label;  // Ambil bulan dari query
            $data[$month - 1] = $item->data;  // Set data sesuai bulan (Jan = 1, maka index = 0)
        }

        // Hitung rata-rata
        $average = array_sum($data) / count($data);

        // Hitung rata-rata ketika tombol ditekan
        $queryTekan = DB::table('data_monitoring')
            ->where('user_id', auth()->user()->id)
            ->whereYear('created_at', $year)
            ->where('tombol_status', 'ditekan')
            ->select(DB::raw('COUNT(*) as jumlah'))
            ->first();

        // Hitung rata-rata ketika tombol tidak ditekan
        $queryTidakTekan = DB::table('data_monitoring')
            ->where('user_id', auth()->user()->id)
            ->whereYear('created_at', $year)
            ->where('tombol_status', 'tidak ditekan')
            ->select(DB::raw('COUNT(*) as jumlah'))
            ->first();

        // Siapkan hasil dalam format JSON
        $result = [
            'data'  => $data,    // Data untuk setiap bulan
            'labels' => $labels, // Label bulan 1 - 12
            'detail' => $getDetailData ?? null,
            'average' => round($average, 0), // Rata-rata data bulanan
            'averageTekan' => $queryTekan->jumlah, // Rata-rata tombol ditekan
            'averageTidakTekan' => $queryTidakTekan->jumlah, // Rata-rata tombol tidak ditekan
        ];
        // dd($result);
        return response()->json($result);
    }

    public function getRiwayatTahunan(Request $request)
    {
        $startyear = $request->startyear ?? date('Y'); 
        $endyear = $request->endtyear ?? date('Y'); 

        $getDetailData = DB::table('data_monitoring')
            ->where('user_id', auth()->user()->id)
            ->whereBetween(DB::raw('YEAR(created_at)'), [$startyear, $endyear])
            ->select(
                        'driver_status',
                        'tombol_status',
                        'created_at'
                    )
            ->get(); 

        // Ambil data dari tabel data_monitoring, dikelompokkan berdasarkan tahun
        $queryResult = DB::table('data_monitoring')
            ->where('user_id', auth()->user()->id)
            ->whereBetween(DB::raw('YEAR(created_at)'), [$startyear, $endyear])
            ->select(DB::raw('YEAR(created_at) as label'), DB::raw('COUNT(*) as data'))
            ->groupBy('label')
            ->get(); 

        // Inisialisasi label dan data
        $labels = range($startyear, $endyear);
        $data = array_fill(0, $endyear - $startyear, 0);
        
        // Isi array data berdasarkan hasil query
        foreach ($queryResult as $key => $item) {
            $year = (int) $item->label;  // Ambil bulan dari query
            $data[] = $item->data;  // Set data sesuai bulan (Jan = 1, maka index = 0)
        }

        // Hitung rata-rata hanya untuk tahun yang memiliki data > 0
        $nonZeroData = array_filter($data, function($value) {
            return $value > 0;
        });

        $average = count($nonZeroData) > 0 ? array_sum($nonZeroData) / count($nonZeroData) : 0;

        // Hitung rata-rata ketika tombol ditekan
        $queryTekan = DB::table('data_monitoring')
            ->where('user_id', auth()->user()->id)
            ->whereBetween(DB::raw('YEAR(created_at)'), [$startyear, $endyear])
            ->where('tombol_status', 'ditekan')
            ->select(DB::raw('COUNT(*) as jumlah'))
            ->first();

        // Hitung rata-rata ketika tombol tidak ditekan
        $queryTidakTekan = DB::table('data_monitoring')
            ->where('user_id', auth()->user()->id)
            ->whereBetween(DB::raw('YEAR(created_at)'), [$startyear, $endyear])
            ->where('tombol_status', 'tidak ditekan')
            ->select(DB::raw('COUNT(*) as jumlah'))
            ->first();

        // Siapkan hasil dalam format JSON
        $result = [
            'data'         => $data,
            'detail'       => $getDetailData ?? null,
            'labels'       => $labels,
            'average'      => round($average, 0),
            'average_tekan' => $queryTekan->jumlah,
            'average_tidak_tekan' => $queryTidakTekan->jumlah
        ];
       
        return response()->json($result);
    }
}
