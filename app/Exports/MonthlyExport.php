<?php

namespace App\Exports;

use App\receive;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MonthlyExport implements FromView , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $search_month;
    protected $search_years;

 function __construct( $search_month ,$search_years) {

        $this->search_month = $search_month;
        $this->search_years = $search_years;
 }
    public function view(): View
    {
        return view('sumary.tablemonthly', [
            'monthlysums' => Receive::whereMonth('created_at', '=', $this->search_month)
            ->whereYear('created_at', '=', $this->search_years)->get()
        ]);
    }
}
