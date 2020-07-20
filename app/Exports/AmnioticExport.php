<?php

namespace App\Exports;

use App\Amnioticfluid;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class AmnioticExport implements FromCollection , WithHeadings , WithMapping , ShouldAutoSize , WithColumnFormatting , WithEvents 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $startDate = request()->input('from_date_amni') ;
        $endDate   = request()->input('to_date_amni') ;
        return Amnioticfluid::whereBetween('created_at', [ $startDate, $endDate ] )
            ->get();
    }

    public function map($amnioticfluid) : array {
        return [
            // Carbon::parse($amnioticfluid->created_at)->format('d/m/Y'),
            \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeToExcel($amnioticfluid->created_at),
            $amnioticfluid->lab_no,
            $amnioticfluid->pt_name,
            $amnioticfluid->pt_add,
            $amnioticfluid->sample_quelity,
            $amnioticfluid->sample_con,
            $amnioticfluid->karyo_result,
            $amnioticfluid->pcr_sent,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->cult_date),
            $amnioticfluid->cult_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->media_date),
            $amnioticfluid->media_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->subcul1_date),
            $amnioticfluid->subcul1_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->subcul2_date),
            $amnioticfluid->subcul2_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->hvest_t1_date),
            $amnioticfluid->hvest_t1_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->hvest_t2_date),
            $amnioticfluid->hvest_t2_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->slide_t1_date),
            $amnioticfluid->slide_t1_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->slide_t2_date),
            $amnioticfluid->slide_t2_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->band_t1_date),
            $amnioticfluid->band_t1_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->band_t2_date),
            $amnioticfluid->band_t2_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->analyz_1_date),
            $amnioticfluid->analyz_1_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->analyz_2_date),
            $amnioticfluid->analyz_2_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->cyto_noti_date),
            $amnioticfluid->cyto_noti_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->report_date),
            $amnioticfluid->report_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->virified_date),
            $amnioticfluid->virified_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($amnioticfluid->email_date),
            $amnioticfluid->email_staff,
            $amnioticfluid->all_remark,
        ] ;
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'M' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Q' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'S' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'U' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'W' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Y' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AA' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AC' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AE' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AG' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AI' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AK' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AM' => NumberFormat::FORMAT_DATE_DDMMYYYY,


        ];
    }
    public function headings() : array {
        return [
            'วันที่รับ',
            'Lab Number',
            'ชื่อ-สกุล',
            'หน่วยงาน',
            'ปริมาณตะกอน',
            'การปนเปื้อน',
            'ผล karyotype',
            'การส่งต่อ QF-PCR',
            'วันที่ culture',
            'ผู้ปฏิบัติงาน',
            'วันที่ media',
            'ผู้ปฏิบัติงาน',
            'วันที่ suculture_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ suculture_2',
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
                $event->sheet->getStyle('A1:AO1')->getFont()->setBold(true);
                $event->sheet->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getStyle('A1:AO1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A1:AO1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C0C0C0');
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '0000'],
                        ],
                    ],
                ];
                
                $event->sheet->getStyle('A1:AO1')->applyFromArray($styleArray);
             },
             
        ];
    }

}
