<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\receive;
use App\Amnioticfluid;
use App\Bloods;
use App\Sentpcr;
use App\Qfpcr;

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

    
}
