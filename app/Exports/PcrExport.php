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
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PcrExport implements FromCollection , WithHeadings , WithMapping , ShouldAutoSize , WithCustomStartCell , WithEvents , WithColumnFormatting 
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
            \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeToExcel($pcrs->created_at),
            $pcrs->lab_no,
            $pcrs->pt_name,
            $pcrs->pt_add,
            $pcrs->sample_type,
            $pcrs->sample_quelity,
            $pcrs->sample_con,
            $pcrs->sample_clot,
            $pcrs->pcr_result,
            $pcrs->dna_conc,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($pcrs->dna_date),
            $pcrs->dna_staff,
            $pcrs->pcr_conc,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($pcrs->pcr_date),
            $pcrs->pcr_staff,
            $pcrs->frag_conc,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($pcrs->frag_date),
            $pcrs->frag_staff,
            $pcrs->dilute_fac,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($pcrs->analyz_date),
            $pcrs->analyz_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($pcrs->virified_date),
            $pcrs->virified_staff,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($pcrs->email_date),
            $pcrs->email_staff,
            $pcrs->remark,
            
        ] ;
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'N' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Q' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'U' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'W' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'X' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'Z' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
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
            'ความเข้มข้น DNA',
            'วันที่ปฏิบัติงาน',
            'ผู้ปฏิบัติงาน',            
            'ความเข้มข้น DNA',
            'วันที่ปฏิบัติงาน PCR',
            'ผู้ปฏิบัติงาน',            
            'ความเข้มข้น DNA',
            'วันที่ปฏิบัติงาน',
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
                $event->sheet->getDelegate()->mergeCells('J1:L1')->setCellValue('J1','DNA Extraction')
                ->getStyle('J1:L1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('M1:O1')->setCellValue('M1','PCR')
                ->getStyle('M1:O1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('P1:R1')->setCellValue('P1','Fragment analysis')
                ->getStyle('P1:R1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('A1:A2')->setCellValue('A1','วันที่รับ')->getStyle('A1:A2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('B1:B2')->setCellValue('B1','Lab Number')->getStyle('B1:B2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('C1:C2')->setCellValue('C1','ชื่อ-สกุล')->getStyle('C1:C2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('D1:D2')->setCellValue('D1','หน่วยงาน')->getStyle('D1:D2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('E1:E2')->setCellValue('E1','ชนิดสิ่งส่งตรวจ')->getStyle('E1:E2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('F1:F2')->setCellValue('F1','ปริมาณตะกอน')->getStyle('F1:F2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('G1:G2')->setCellValue('G1','การปนเปื้อน')->getStyle('G1:G2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('H1:H2')->setCellValue('H1','ลักษณะ')->getStyle('H1:H2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('I1:I2')->setCellValue('I1','ผล PCR')->getStyle('I1:I2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('S1:S2')->setCellValue('S1','Dilution')->getStyle('S1:S2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('T1:T2')->setCellValue('T1','วันที่ analyzed')->getStyle('T1:T2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('U1:U2')->setCellValue('U1','ผู้ปฏิบัติงาน')->getStyle('U1:U2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('V1:V2')->setCellValue('V1','วันที่ verified')->getStyle('V1:V2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('W1:W2')->setCellValue('W1','ผู้ปฏิบัติงาน')->getStyle('W1:W2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('X1:X2')->setCellValue('X1','วันที่ส่ง e-mail')->getStyle('X1:X2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('Y1:Y2')->setCellValue('Y1','ผู้ปฏิบัติงาน')->getStyle('Y1:Y2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('Z1:Z2')->setCellValue('Z1','remark')->getStyle('Z1:Z2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A1:Z2')->getFont()->setBold(true);
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '0000'],
                        ],
                    ],
                ];
                
                $event->sheet->getStyle('A1:Z2')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1:Z2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C0C0C0');
             },
             
        ];
    }
}
