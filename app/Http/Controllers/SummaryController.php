<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\receive;
use DB;
use App\Exports\SummaryExport;
use App\Exports\MonthlyExport;
use Maatwebsite\Excel\Facades\Excel;

class SummaryController extends Controller
{
    public function labsumary()
    {
        $search_hospital = \Request::get('search_hospital');
        $search_month = \Request::get('search_month');
        $search_years = \Request::get('search_years');
        $sumrecive = receive::whereYear('created_at', '=', $search_years)
            ->whereMonth('created_at', '=', $search_month)
            ->where('chromo_hos', 'like', '%' .$search_hospital. '%')->orderBy('created_at', 'DESC')->get();
        $sumsent_ex = receive::whereYear('created_at', '=', $search_years)
            ->whereMonth('created_at', '=', $search_month)
            ->where('chromo_hos', 'like', '%' .$search_hospital. '%')->orderBy('created_at', 'DESC')->first();
        $hoslist = DB::table('hospitals')->get();
        $ria = receive::select(\DB::raw("COUNT(*) as count"))
        ->where('chromo_hos', '=', 'RIA Lab')
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
 
        $hos_7 = receive::select(\DB::raw("COUNT(*) as count"))
        ->where('chromo_hos', '=', 'ศูนย์อนามัยที่ 7')
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
        $bmg = receive::select(\DB::raw("COUNT(*) as count"))
        ->where('chromo_hos', '=', 'BMG')
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
        $hos_sri = receive::select(\DB::raw("COUNT(*) as count"))
        ->where('chromo_hos', '=', 'รพ.ศรีนครินทร์')
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
        $hos_pon = receive::select(\DB::raw("COUNT(*) as count"))
        ->where('chromo_hos', '=', 'รพ.พล')
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
        $hos_kala = receive::select(\DB::raw("COUNT(*) as count"))
        ->where('chromo_hos', '=', 'รพ.กาฬสินธุ์')
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
        $hos_chom = receive::select(\DB::raw("COUNT(*) as count"))
        ->where('chromo_hos', '=', 'รพ.ชุมแพ')
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
        $doc_pee = receive::select(\DB::raw("COUNT(*) as count"))
        ->where('chromo_hos', '=', 'หมอพีระยุทธิ์')
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
 
        return view('sumary.labsum', compact('sumrecive','hoslist','ria','hos_7','bmg','hos_sri','hos_pon','hos_kala','hos_chom','doc_pee','sumsent_ex'));
    }

    
    public function export_view(Request $request) 
    {
        return Excel::download(new SummaryExport($request->search_hospital , $request->search_month,$request->search_years ), 'สรุปหน่วยงาน.xlsx');
    }

    public function monthly_sumary()
    {

        $search_month = \Request::get('search_month');
        $search_years = \Request::get('search_years');
        $monthlysums = receive::whereYear('created_at', '=', $search_years)
            ->whereMonth('created_at', '=', $search_month)
            ->orderBy('created_at', 'DESC')->get();
        $monthly_fisrt = receive::whereYear('created_at', '=', $search_years)
            ->whereMonth('created_at', '=', $search_month)->orderBy('created_at', 'DESC')->first();

        return view('sumary.monthly', compact('monthlysums','monthly_fisrt'));
    }

    public function export_monthly(Request $request) 
    {
        return Excel::download(new MonthlyExport( $request->search_month,$request->search_years ), 'สรุปรายเดือน.xlsx');
    }
}
