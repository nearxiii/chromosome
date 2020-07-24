<?php

namespace App\Exports;

use App\Receive;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SummaryExport implements FromView , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $search_hospital;
    protected $search_month;
    protected $search_years;

 function __construct($search_hospital , $search_month ,$search_years) {
        $this->search_hospital = $search_hospital;
        $this->search_month = $search_month;
        $this->search_years = $search_years;
 }
    public function view(): View
    {
        return view('sumary.table', [
            'sumrecive' => Receive::where('chromo_hos', 'like', '%' .$this->search_hospital. '%')->whereMonth('created_at', '=', $this->search_month)
            ->whereYear('created_at', '=', $this->search_years)->get()
        ]);
    }
}
