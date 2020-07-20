<?php

namespace App\Exports;

use App\Bloods;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class BloodExport implements FromCollection , WithHeadings , WithMapping , ShouldAutoSize , WithColumnFormatting , WithEvents 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $startDate = request()->input('from_date_blood') ;
        $endDate   = request()->input('to_date_blood') ;
        return Bloods::whereBetween('created_at', [ $startDate, $endDate ] )
            ->get();
    }
    public function map($bloods) : array {
        return [
            \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeToExcel($bloods->created_at),
            $bloods->lab_no,
            $bloods->pt_name,
            $bloods->pt_add,
            $bloods->sample_quelity,
            $bloods->karyotype_result,
            $bloods->pcr_sent,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->cult_date),
            $bloods->cult_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->hvest_t1_date),
            $bloods->hvest_t1_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->hvest_t2_date),
            $bloods->hvest_t2_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->slide_t1_date),
            $bloods->slide_t1_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->slide_t2_date),
            $bloods->slide_t2_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->band_t1_date),
            $bloods->band_t1_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->band_t2_date),
            $bloods->band_t2_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->analyz_1_date),
            $bloods->analyz_1_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->analyz_2_date),
            $bloods->analyz_2_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->cyto_noti_date),
            $bloods->cyto_noti_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->report_date),
            $bloods->report_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->virified_date),
            $bloods->virified_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($bloods->email_date),
            $bloods->email_staff,
            $bloods->all_remark,
        ] ;
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'N' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'P' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'R' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'T' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'V' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'X' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Z' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AB' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AD' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AF' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
    public function headings() : array {
        return [
            'วันที่รับ',
            'Lab Number',
            'ชื่อ-สกุล',
            'หน่วยงาน',
            'ลักษณะ',
            'ผล karyotype',
            'การส่งต่อ QF-PCR',
            'วันที่ culture',
            'ผู้ปฏิบัติงาน',
            'วันที่ harvest_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ harvest_2',
            'ผู้ปฏิบัติงาน',
            'วันที่ slide_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ slide_2',
            'ผู้ปฏิบัติงาน',
            'วันที่ band_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ band_2',
            'ผู้ปฏิบัติงาน',
            'วันที่ analyze_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ analyze_2',
            'ผู้ปฏิบัติงาน',
            'วันที่ cytogenetic',
            'ผู้ปฏิบัติงาน',
            'วันที่ report',
            'ผู้ปฏิบัติงาน',
            'วันที่ verified',
            'ผู้ปฏิบัติงาน',
            'วันที่ส่ง e-mail',
            'ผู้ปฏิบัติงาน',
            'remark',
            
        ] ;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:AH1')->getFont()->setBold(true);
                $event->sheet->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getStyle('A1:AH1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A1:AH1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C0C0C0');;
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '0000'],
                        ],
                    ],
                ];
                
                $event->sheet->getStyle('A1:AH1')->applyFromArray($styleArray);
             },
             
        ];
    }

}
