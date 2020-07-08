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
        $amniotics = Amnioticfluid::all()->sortByDesc('created_at');
        $bloods = Bloods::all()->sortByDesc('created_at');
        $pcrs = Qfpcr::all()->sortByDesc('created_at');
        $senteds = Sentpcr::all()->sortByDesc('created_at');
        return view('result', compact('amniotics','bloods','pcrs','senteds'));
    }
}
