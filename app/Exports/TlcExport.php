<?php

namespace App\Exports;

use App\receive;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TlcExport implements FromView , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $date_from;
    protected $date_to;

 function __construct( $date_from ,$date_to) {

        $this->date_from = $date_from;
        $this->date_to = $date_to;
 }
    public function view(): View
    {
        return view('sumary.tabletlc', [
            'tlcsums' => Receive::where('logis_staff', '=', 'TLC')->whereBetween('created_at', [ $this->date_from, $this->date_to ] )->get()
        ]);
    }
}
