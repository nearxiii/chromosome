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
