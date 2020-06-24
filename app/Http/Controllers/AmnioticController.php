<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\receive;
use DB;
use App\Amnioticfluid;

class AmnioticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $namelist = DB::table('receives')->get();
        $amniotic = Amnioticfluid::all()->sortByDesc('id');
        return view('amniotic',compact('namelist','amniotic'));
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
            'sample_quelity'=>'required',
            'sample_con'=>'required',
                                   
        ],[
            'sample_quelity.required'=> 'กรุณาตรวจสอบปริมาณตะกอน', 
            'sample_con.required'=> 'กรุณาตรวจสอบการปนเปื้อนเลือด', 
           
         ]);
        
        $Amniotic = new Amnioticfluid([
            'created_at' => $request->get('created_at'),
            'pt_name' => $request->get('pt_name'),
            'lab_no' => $request->get('lab_no'),
            'pt_add' => $request->get('pt_add'),
            'sample_con' => implode(" , ",$request->get('sample_con')) ,
            'sample_quelity' => $request->get('sample_quelity'),
            
        ]);
        $Amniotic->save();
        
        return redirect('/amniotic')->with('success', 'เพิ่มข้อมูลการรับสิ่งส่งตรวจเรียบร้อย!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function findlabno(Request $request)
    {
       
        $name_id = $request->get('labname');
        $data=DB::table('receives')->where('id',$name_id)->get();
        return response()->json($data);
       
     
    }
}
