<?php

namespace App\Exports;

use App\receive;
use Maatwebsite\Excel\Concerns\FromCollection;

class TlcExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return receive::all();
    }
}
