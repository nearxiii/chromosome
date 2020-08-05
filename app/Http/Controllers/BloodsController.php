<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bloods;

class BloodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $namelist = DB::table('receives')->get();
        $search = \Request::get('search_name');
        $bloods = Bloods::where('pt_name', 'like', '%' .$search. '%')->orderBy('created_at', 'DESC')->paginate(20);
        return view('bloods.bloods',compact('bloods','namelist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sample_quelity'=>'required'                                   
        ],[
            'sample_quelity.required'=> 'กรุณาตรวจสอบปริมาณตะกอน'           
         ]);
        
        $Bloods = new Bloods([
            'created_at' => $request->get('created_at'),
            'pt_name' => $request->get('pt_name'),
            'lab_no' => $request->get('lab_no'),
            'pt_add' => $request->get('pt_add'),
            'sample_quelity' => $request->get('sample_quelity')
        ]);
        $Bloods->save();
        
        return redirect('/bloods')->with('success', 'เพิ่มข้อมูลการรับสิ่งส่งตรวจเรียบร้อย!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $b_pcrs = Bloods::find($id);
        return view('bloods.bsentpcr', compact('b_pcrs'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $karyotype = Bloods::find($id);
        // culture
        $karyotype->cult_date =  $request->get('cult_date');
        $karyotype->cult_time =  $request->get('cult_time');
        $karyotype->cult_staff =  $request->get('cult_staff');
        $karyotype->cult_remark =  $request->get('cult_remark');
        // havest
        $karyotype->hvest_t1_date =  $request->get('hvest_t1_date');
        $karyotype->hvest_t1_time =  $request->get('hvest_t1_time');
        $karyotype->hvest_t1_staff =  $request->get('hvest_t1_staff');
        $karyotype->hvest_t1_remark =  $request->get('hvest_t1_remark');
        $karyotype->hvest_t2_date =  $request->get('hvest_t2_date');
        $karyotype->hvest_t2_time =  $request->get('hvest_t2_time');
        $karyotype->hvest_t2_staff =  $request->get('hvest_t2_staff');
        $karyotype->hvest_t2_remark =  $request->get('hvest_t2_remark');
        // slide
        $karyotype->slide_t1_date =  $request->get('slide_t1_date');
        $karyotype->slide_t1_time =  $request->get('slide_t1_time');
        $karyotype->slide_t1_staff =  $request->get('slide_t1_staff');
        $karyotype->slide_t1_remark =  $request->get('slide_t1_remark');
        $karyotype->slide_t2_date =  $request->get('slide_t2_date');
        $karyotype->slide_t2_time =  $request->get('slide_t2_time');
        $karyotype->slide_t2_staff =  $request->get('slide_t2_staff');
        $karyotype->slide_t2_remark =  $request->get('slide_t2_remark');
        // band
        $karyotype->band_t1_date =  $request->get('band_t1_date');
        $karyotype->band_t1_time =  $request->get('band_t1_time');
        $karyotype->band_t1_staff =  $request->get('band_t1_staff');
        $karyotype->band_t1_remark =  $request->get('band_t1_remark');
        $karyotype->band_t2_date =  $request->get('band_t2_date');
        $karyotype->band_t2_time =  $request->get('band_t2_time');
        $karyotype->band_t2_staff =  $request->get('band_t2_staff');
        $karyotype->band_t2_remark =  $request->get('band_t2_remark');
        // analyzed
        $karyotype->analyz_1_date =  $request->get('analyz_1_date');
        $karyotype->analyz_1_time =  $request->get('analyz_1_time');
        $karyotype->analyz_1_staff =  $request->get('analyz_1_staff');
        $karyotype->analyz_1_remark =  $request->get('analyz_1_remark');
        $karyotype->analyz_2_date =  $request->get('analyz_2_date');
        $karyotype->analyz_2_time =  $request->get('analyz_2_time');
        $karyotype->analyz_2_staff =  $request->get('analyz_2_staff');
        $karyotype->analyz_2_remark =  $request->get('analyz_2_remark');
        // cyto
        $karyotype->cyto_noti_date =  $request->get('cyto_noti_date');
        $karyotype->cyto_noti_time =  $request->get('cyto_noti_time');
        $karyotype->cyto_noti_staff =  $request->get('cyto_noti_staff');
        $karyotype->cyto_noti_remark =  $request->get('cyto_noti_remark');
        // report
        $karyotype->report_date =  $request->get('report_date');
        $karyotype->report_time =  $request->get('report_time');
        $karyotype->report_staff =  $request->get('report_staff');
        $karyotype->report_remark =  $request->get('report_remark');
        // result
        $karyotype->karyotype_result =  $request->get('karyotype_result');
        $karyotype->virified_staff =  $request->get('virified_staff');
        $karyotype->virified_date =  $request->get('virified_date');
        $karyotype->email_staff =  $request->get('email_staff');
        $karyotype->email_date =  $request->get('email_date');
        $karyotype->all_remark =  $request->get('all_remark');
        $karyotype->pcr_sent =  $request->get('pcr_sent');
        $karyotype->save();

        return redirect('/bloods')->with('success', 'อัพเดทสถานะเรียบร้อย!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyotype = Bloods::find($id);
        $karyotype->delete();
        return redirect('/bloods')->with('success', 'ลบขุ้อมูลเรียบร้อย!');
    }
}
