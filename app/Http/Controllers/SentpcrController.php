<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sentpcr;

class SentpcrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $senteds = Sentpcr::all()->sortByDesc('id');
        return view('sentedpcr.sentedpcr',compact('senteds'));
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
        
        $sented = new Sentpcr([
            'created_at' => $request->get('created_at'),
            'pt_name' => $request->get('pt_name'),
            'lab_no' => $request->get('lab_no'),
            'pt_add' => $request->get('pt_add'),
            'sample_con' => $request->get('sample_con') ,
            'sample_quelity' => $request->get('sample_quelity'),
            
        ]);
        $sented->save();
        
        return redirect('/sentedpcr')->with('success', 'ส่งต่อ QF-PCR เรียบร้อย!');
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
}
