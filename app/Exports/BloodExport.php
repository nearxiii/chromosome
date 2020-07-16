<?php

namespace App\Exports;

use App\Bloods;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BloodExport implements FromCollection , WithHeadings , WithMapping , ShouldAutoSize
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
            Carbon::parse($bloods->created_at)->format('d/m/Y'),
            $bloods->lab_no,
            $bloods->pt_name,
            $bloods->pt_add,
            $bloods->sample_quelity,
            $bloods->karyotype_result,
            $bloods->pcr_sent,
            Carbon::parse($bloods->cult_date)->format('d/m/Y'),
            Carbon::parse($bloods->cult_time)->format('H:i'),
            $bloods->cult_staff,
            Carbon::parse($bloods->hvest_t1_date)->format('d/m/Y'),
            Carbon::parse($bloods->hvest_t1_time)->format('H:i'),
            $bloods->hvest_t1_staff,
            Carbon::parse($bloods->hvest_t2_date)->format('d/m/Y'),
            Carbon::parse($bloods->hvest_t2_time)->format('H:i'),
            $bloods->hvest_t2_staff,
            Carbon::parse($bloods->slide_t1_date)->format('d/m/Y'),
            Carbon::parse($bloods->slide_t1_time)->format('H:i'),
            $bloods->slide_t1_staff,
            Carbon::parse($bloods->slide_t2_date)->format('d/m/Y'),
            Carbon::parse($bloods->slide_t2_time)->format('H:i'),
            $bloods->slide_t2_staff,
            Carbon::parse($bloods->band_t1_date)->format('d/m/Y'),
            Carbon::parse($bloods->band_t1_time)->format('H:i'),
            $bloods->band_t1_staff,
            Carbon::parse($bloods->band_t2_date)->format('d/m/Y'),
            Carbon::parse($bloods->band_t2_time)->format('H:i'),
            $bloods->band_t2_staff,
            Carbon::parse($bloods->analyz_1_date)->format('d/m/Y'),
            Carbon::parse($bloods->analyz_1_time)->format('H:i'),
            $bloods->analyz_1_staff,
            Carbon::parse($bloods->analyz_2_date)->format('d/m/Y'),
            Carbon::parse($bloods->analyz_2_time)->format('H:i'),
            $bloods->analyz_2_staff,
            Carbon::parse($bloods->cyto_noti_date)->format('d/m/Y'),
            Carbon::parse($bloods->cyto_noti_time)->format('H:i'),
            $bloods->cyto_noti_staff,
            Carbon::parse($bloods->report_date)->format('d/m/Y'),
            Carbon::parse($bloods->report_time)->format('H:i'),
            $bloods->report_staff,
            Carbon::parse($bloods->virified_date)->format('d/m/Y'),
            $bloods->virified_staff,
            Carbon::parse($bloods->email_date)->format('d/m/Y'),
            $bloods->email_staff,
            $bloods->all_remark,
        ] ;
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
            'เวลา culture',
            'ผู้ปฏิบัติงาน',
            'วันที่ harvest_1',
            'เวลา harvest_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ harvest_2',
            'เวลา harvest_2',
            'ผู้ปฏิบัติงาน',
            'วันที่ slide_1',
            'เวลา slide_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ slide_2',
            'เวลา slide_2',
            'ผู้ปฏิบัติงาน',
            'วันที่ band_1',
            'เวลา band_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ band_2',
            'เวลา band_2',
            'ผู้ปฏิบัติงาน',
            'วันที่ analyze_1',
            'เวลา analyze_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ analyze_2',
            'เวลา analyze_2',
            'ผู้ปฏิบัติงาน',
            'วันที่ cytogenetic',
            'เวลา cytogenetic',
            'ผู้ปฏิบัติงาน',
            'วันที่ report',
            'เวลา report',
            'ผู้ปฏิบัติงาน',
            'วันที่ verified',
            'ผู้ปฏิบัติงาน',
            'วันที่ส่ง e-mail',
            'ผู้ปฏิบัติงาน',
            'remark',
            
        ] ;
    }
}
