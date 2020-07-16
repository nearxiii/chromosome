<?php

namespace App\Exports;

use App\Sentpcr;
use Maatwebsite\Excel\Concerns\FromCollection;

class SentpcrExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sentpcr::all();
    }
}
