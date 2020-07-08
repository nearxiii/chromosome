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
             
        $sented = new Sentpcr([
            'created_at' => $request->get('created_at'),
            'pt_name' => $request->get('pt_name'),
            'lab_no' => $request->get('lab_no'),
            'pt_add' => $request->get('pt_add'),
            'sample_con' => $request->get('sample_con') ,
            'sample_quelity' => $request->get('sample_quelity'),
            'sample_clot' => $request->get('sample_clot')
            
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
        $sentpcr = Sentpcr::find($id);
        // dna
        $sentpcr->dna_conc =  $request->get('dna_conc');
        $sentpcr->dna_date =  $request->get('dna_date');
        $sentpcr->dna_time =  $request->get('dna_time');
        $sentpcr->dna_staff =  $request->get('dna_staff');
        $sentpcr->dna_remark =  $request->get('dna_remark');
        // pcr 
        $sentpcr->pcr_conc =  $request->get('pcr_conc');
        $sentpcr->pcr_date =  $request->get('pcr_date');
        $sentpcr->pcr_time =  $request->get('pcr_time');
        $sentpcr->pcr_staff =  $request->get('pcr_staff');
        $sentpcr->pcr_remark =  $request->get('pcr_remark');
        // fragment
        $sentpcr->frag_conc =  $request->get('frag_conc');
        $sentpcr->frag_date =  $request->get('frag_date');
        $sentpcr->frag_time =  $request->get('frag_time');
        $sentpcr->frag_staff =  $request->get('frag_staff');
        $sentpcr->frag_remark =  $request->get('frag_remark');
        // result
        $sentpcr->dilute_fac =  $request->get('dilute_fac');
        $sentpcr->pcr_result =  $request->get('pcr_result');
        $sentpcr->virified_staff =  $request->get('virified_staff');
        $sentpcr->virified_date =  $request->get('virified_date');
        $sentpcr->email_staff =  $request->get('email_staff');
        $sentpcr->email_date =  $request->get('email_date');
        $sentpcr->remark =  $request->get('remark');
        $sentpcr->save();

        return redirect('/sentedpcr')->with('success', 'อัพเดทสถานะเรียบร้อย!');
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
