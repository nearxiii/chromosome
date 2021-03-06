<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\receive;
use App\Amnioticfluid;
use App\Bloods;
use App\Sentpcr;
use App\Qfpcr;
use App\Exports\AmnioticExport;
use App\Exports\BloodExport;
use App\Exports\PcrExport;
use App\Exports\SentpcrExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class Homecontroller extends Controller
{
    public function index()
    {
       
        $chromoslast = receive::where('email_date','=',NULL)->orderBy('created_at')->paginate(100);
        $amniotic_no = receive::where('sample_type', '=', 'น้ำคร่ำ')->where('email_date','=',NULL)->get();
        $blood_no = receive::where('sample_type', '=', 'เลือด')->where('email_date','=',NULL)->get();
        $pcr_no = receive::where('chromo_test', '=', 'QF-PCR')->where('email_date','=',NULL)->get();
        return view('welcome', compact('amniotic_no','chromoslast','blood_no','pcr_no'));
    }

    public function result()
    {
        $search_amni = \Request::get('search_amni');
        $amniotics = Amnioticfluid::where('pt_name', 'like', '%' .$search_amni. '%')->orderBy('created_at', 'DESC')->paginate(20);
        $search_blood = \Request::get('search_blood');
        $bloods = Bloods::where('pt_name', 'like', '%' .$search_blood. '%')->orderBy('created_at', 'DESC')->paginate(20);
        $search_pcr = \Request::get('search_pcr');
        $pcrs = Qfpcr::where('pt_name', 'like', '%' .$search_pcr. '%')->orderBy('created_at', 'DESC')->paginate(20);
        $search_sent = \Request::get('search_sent');
        $senteds = Sentpcr::where('pt_name', 'like', '%' .$search_sent. '%')->orderBy('created_at', 'DESC')->paginate(20);
        
        return view('result', compact('amniotics','bloods','pcrs','senteds'));
    }

    public function export_amni( Request $request ) {

        return Excel::download( new AmnioticExport(), 'สรุปน้ำคร่ำ.xlsx') ;
    }
    public function export_blood( Request $request ) {

        return Excel::download( new BloodExport(), 'สรุปเลือด.xlsx') ;
    }
    public function export_pcr( Request $request ) {

        return Excel::download( new PcrExport(), 'สรุปQF-PCR.xlsx') ;
    }
    public function export_sentpcr( Request $request ) {

        return Excel::download( new SentpcrExport(), 'สรุปส่งต่อQF-PCR.xlsx') ;
    }

  
}
