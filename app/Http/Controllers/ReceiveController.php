<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\receive;
use DB;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = \Request::get('search');
        $chromos = receive::where('chromo_test', 'like', '%' .$search. '%')->orderBy('created_at', 'DESC')->paginate(17);
        // $chromos = receive::all()->sortByDesc('id');
        $karyotype_no = receive::where('chromo_test', '=', 'Karyotyping')->latest('id')->first();
        $pcr_no = receive::where('chromo_test', '=', 'QF-PCR')->latest('id')->first();
        $combo_no = receive::where('chromo_test', '=', 'Combo')->latest('id')->first();
        $hoslist = DB::table('hospitals')->get();
        
        

        return view('receive.index', compact('chromos','karyotype_no','pcr_no','combo_no','hoslist'));
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
            'chromo_name'=>'required',
            'chromo_hos'=>'required',
            'sample_type'=>'required',
            'chromo_test'=>'required',
            'chromo_number'=>'required',
            'rev_staff'=>'required',
            'logis_staff'=>'required',
            'chromo_doc'=>'required',
                        
        ],[
            'chromo_name.required'=> 'กรุณากรอกชื่อ', 
            'chromo_doc.required'=> 'กรุณากรอกชื่อแพทย์', 
            'chromo_number.required'=> 'กรุณากรอก lab number', 
            'chromo_test.required'=> 'กรุณาเลือกรายการตรวจ', 
            'chromo_hos.required'=> 'กรุณาเลือกหน่วยงาน', 
            'sample_type.required'=> 'กรุณาเลือกชนิดสิ่งส่งตรวจ'
         ]);
        
        $Chromosome = new receive([
            'created_at' => $request->get('created_at'),
            'chromo_name' => $request->get('chromo_name'),
            'chromo_doc' => $request->get('chromo_doc'),
            'chromo_hos' => $request->get('chromo_hos'),
            'sample_type' => $request->get('sample_type'),
            'chromo_test' => $request->get('chromo_test'),
            'chromo_number' => $request->get('chromo_number'),
            'rev_staff' => $request->get('rev_staff'),
            'logis_staff' => $request->get('logis_staff'),
            'chromo_remark' => $request->get('chromo_remark')
        ]);
        $Chromosome->save();
        
        return redirect('/receive')->with('success', 'เพิ่มข้อมูลการรับสิ่งส่งตรวจเรียบร้อย!');
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
        $chromoedits = receive::find($id);
        return view('receive.index', compact('chromoedits'));  
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
        

        $sent = receive::find($id);
        $sent->report_date =  $request->get('report_date');
        $sent->email_date =  $request->get('email_date');
        $sent->combo_qf_date =  $request->get('combo_qf_date');
        $sent->combo_qf_email =  $request->get('combo_qf_email');
        $sent->chromo_remark =  $request->get('chromo_remark');
        
        
        $sent->save();

        return redirect('/receive')->with('success', 'อัพเดทสถานะเรียบร้อย!');
    }
    public function update_rev(Request $request, $id)
    {
        

        $sent = receive::find($id);
        $sent->created_at =  $request->get('created_at');
        $sent->chromo_name =  $request->get('chromo_name');
        $sent->chromo_doc =  $request->get('chromo_doc');
        $sent->chromo_hos =  $request->get('chromo_hos');
        $sent->chromo_remark =  $request->get('chromo_remark');
        
        
        $sent->save();

        return redirect('/receive')->with('success', 'แก้ไขข้อมูลเรียบร้อย!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chromo = receive::find($id);
        $chromo->delete();
        return redirect('/receive')->with('success', 'ลบขุ้อมูลเรียบร้อย!');
    }
    
}
