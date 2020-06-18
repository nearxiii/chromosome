<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\receive;

class Homecontroller extends Controller
{
    public function index()
    {
       
        $chromoslast = receive::where('email_date','=',NULL)->orderBy('created_at', 'DESC')->paginate(20);
        $amniotic_no = receive::where('sample_type', '=', 'น้ำคร่ำ')->where('email_date','=',NULL)->get();
        return view('welcome', compact('amniotic_no','chromoslast'));
    }
}
