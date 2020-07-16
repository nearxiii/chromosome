<?php

namespace App\Exports;

use App\Qfpcr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class PcrExport implements FromCollection , WithHeadings , WithMapping , ShouldAutoSize , WithCustomStartCell , WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $startDate = request()->input('from_date_pcr') ;
        $endDate   = request()->input('to_date_pcr') ;
        return Qfpcr::whereBetween('created_at', [ $startDate, $endDate ] )
            ->get();
    }
    public function map($pcrs) : array {
        return [
            Carbon::parse($pcrs->created_at)->format('d/m/Y'),
            $pcrs->lab_no,
            $pcrs->pt_name,
            $pcrs->pt_add,
            $pcrs->sample_type,
            $pcrs->sample_quelity,
            $pcrs->sample_con,
            $pcrs->sample_clot,
            $pcrs->pcr_result,
            $pcrs->dna_conc,
            Carbon::parse($pcrs->dna_date)->format('d/m/Y'),
            Carbon::parse($pcrs->dna_time)->format('H:i'),
            $pcrs->dna_staff,
            $pcrs->pcr_conc,
            Carbon::parse($pcrs->pcr_date)->format('d/m/Y'),
            Carbon::parse($pcrs->pcr_time)->format('H:i'),
            $pcrs->pcr_staff,
            $pcrs->frag_conc,
            Carbon::parse($pcrs->frag_date)->format('d/m/Y'),
            Carbon::parse($pcrs->frag_time)->format('H:i'),
            $pcrs->frag_staff,
            $pcrs->dilute_fac,
            $pcrs->analyz_staff,
            Carbon::parse($pcrs->analyz_date)->format('d/m/Y'),
            $pcrs->virified_staff,
            Carbon::parse($pcrs->virified_date)->format('d/m/Y'),
            Carbon::parse($pcrs->analyz_date)->format('d/m/Y'),
            $pcrs->email_staff,
            Carbon::parse($pcrs->email_date)->format('d/m/Y'),
            $pcrs->remark,
            
        ] ;
    }

    public function headings() : array {
        return [
            'วันที่รับ',
            'Lab Number',
            'ชื่อ-สกุล',
            'หน่วยงาน',
            'ชนิดสิ่งส่งตรวจ',
            'ปริมาณตะกอน',
            'การปนเปื้อน',
            'ลักษณะ',
            'ผล PCR',
            'DNA.Ex ความเข้มข้น',
            'วันที่ DNA.Ex',
            'เวลา DNA.Ex',
            'ผู้ปฏิบัติงาน',            
            'PCR ความเข้มข้น',
            'วันที่ PCR',
            'เวลา PCR',
            'ผู้ปฏิบัติงาน',            
            'Fragment ความเข้มข้น',
            'วันที่ Fragment',
            'เวลา Fragment',
            'ผู้ปฏิบัติงาน',            
            'Dilution',            
            'วันที่ analyzed',            
            'ผู้ปฏิบัติงาน',            
            'วันที่ verified',            
            'ผู้ปฏิบัติงาน',            
            'วันที่ส่ง e-mail',            
            'ผู้ปฏิบัติงาน',            
            'remark',            
        ] ;
    }
    public function startCell(): string
    {
        return 'A2';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('J1:M1');
                $event->sheet->getDelegate()->setCellValue('J1','The quick brown fox.');
             },
        ];
    }
}
