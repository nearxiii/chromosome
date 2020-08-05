<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qfpcr;
use DB;
class QfpcrController extends Controller
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
        $pcrs = Qfpcr::where('pt_name', 'like', '%' .$search. '%')->orderBy('id', 'DESC')->paginate(20);
        // $amniotic = Amnioticfluid::all()->sortByDesc('id');
        return view('pcr.index',compact('namelist','pcrs'));
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
        if($request->input('sample_con') == ''){
            $pcr = new Qfpcr([
                'created_at' => $request->get('created_at'),
                'pt_name' => $request->get('pt_name'),
                'lab_no' => $request->get('lab_no'),
                'pt_add' => $request->get('pt_add'),
                'sample_type' => $request->get('sample_type'),
                'sample_quelity' => $request->get('sample_quelity'),
                'sample_clot' => $request->get('sample_clot')
            ]);
            $pcr->save();
          }else{
            $pcr = new Qfpcr([
                'created_at' => $request->get('created_at'),
                'pt_name' => $request->get('pt_name'),
                'lab_no' => $request->get('lab_no'),
                'pt_add' => $request->get('pt_add'),
                'sample_type' => $request->get('sample_type'),
                'sample_con' => implode(" , ",$request->get('sample_con')) ,
                'sample_quelity' => $request->get('sample_quelity'),
                'sample_clot' => $request->get('sample_clot')
            ]);
            $pcr->save();
          }
        
        
        return redirect('/pcr')->with('success', 'เพิ่มข้อมูลการรับสิ่งส่งตรวจเรียบร้อย!');
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
        $qfpcrs = Qfpcr::find($id);
        // dna
        $qfpcrs->dna_conc =  $request->get('dna_conc');
        $qfpcrs->dna_date =  $request->get('dna_date');
        $qfpcrs->dna_time =  $request->get('dna_time');
        $qfpcrs->dna_staff =  $request->get('dna_staff');
        $qfpcrs->dna_remark =  $request->get('dna_remark');
        // pcr 
        $qfpcrs->pcr_conc =  $request->get('pcr_conc');
        $qfpcrs->pcr_date =  $request->get('pcr_date');
        $qfpcrs->pcr_time =  $request->get('pcr_time');
        $qfpcrs->pcr_staff =  $request->get('pcr_staff');
        $qfpcrs->pcr_remark =  $request->get('pcr_remark');
        // fragment
        $qfpcrs->frag_conc =  $request->get('frag_conc');
        $qfpcrs->frag_date =  $request->get('frag_date');
        $qfpcrs->frag_time =  $request->get('frag_time');
        $qfpcrs->frag_staff =  $request->get('frag_staff');
        $qfpcrs->frag_remark =  $request->get('frag_remark');
        // result
        $qfpcrs->dilute_fac =  $request->get('dilute_fac');
        $qfpcrs->pcr_result =  $request->get('pcr_result');
        $qfpcrs->virified_staff =  $request->get('virified_staff');
        $qfpcrs->virified_date =  $request->get('virified_date');
        $qfpcrs->email_staff =  $request->get('email_staff');
        $qfpcrs->email_date =  $request->get('email_date');
        $qfpcrs->remark =  $request->get('remark');
        $qfpcrs->save();

        return redirect('/pcr')->with('success', 'อัพเดทสถานะเรียบร้อย!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qfpcr = Qfpcr::find($id);
        $qfpcr->delete();
        return redirect('/pcr')->with('success', 'ลบขุ้อมูลเรียบร้อย!');
    }
}
