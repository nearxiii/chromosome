<?php

namespace App\Exports;

use App\Amnioticfluid;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AmnioticExport implements FromCollection , WithHeadings , WithMapping , ShouldAutoSize
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
            Carbon::parse($amnioticfluid->created_at)->format('d/m/Y'),
            $amnioticfluid->lab_no,
            $amnioticfluid->pt_name,
            $amnioticfluid->pt_add,
            $amnioticfluid->sample_quelity,
            $amnioticfluid->sample_con,
            $amnioticfluid->karyo_result,
            $amnioticfluid->pcr_sent,
            Carbon::parse($amnioticfluid->cult_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->cult_time)->format('H:i'),
            $amnioticfluid->cult_staff,
            Carbon::parse($amnioticfluid->media_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->media_time)->format('H:i'),
            $amnioticfluid->media_staff,
            Carbon::parse($amnioticfluid->subcul1_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->subcul1_time)->format('H:i'),
            $amnioticfluid->subcul1_staff,
            Carbon::parse($amnioticfluid->subcul2_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->subcul2_time)->format('H:i'),
            $amnioticfluid->subcul2_staff,
            Carbon::parse($amnioticfluid->hvest_t1_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->hvest_t1_time)->format('H:i'),
            $amnioticfluid->hvest_t1_staff,
            Carbon::parse($amnioticfluid->hvest_t2_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->hvest_t2_time)->format('H:i'),
            $amnioticfluid->hvest_t2_staff,
            Carbon::parse($amnioticfluid->slide_t1_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->slide_t1_time)->format('H:i'),
            $amnioticfluid->slide_t1_staff,
            Carbon::parse($amnioticfluid->slide_t2_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->slide_t2_time)->format('H:i'),
            $amnioticfluid->slide_t2_staff,
            Carbon::parse($amnioticfluid->band_t1_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->band_t1_time)->format('H:i'),
            $amnioticfluid->band_t1_staff,
            Carbon::parse($amnioticfluid->band_t2_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->band_t2_time)->format('H:i'),
            $amnioticfluid->band_t2_staff,
            Carbon::parse($amnioticfluid->analyz_1_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->analyz_1_time)->format('H:i'),
            $amnioticfluid->analyz_1_staff,
            Carbon::parse($amnioticfluid->analyz_2_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->analyz_2_time)->format('H:i'),
            $amnioticfluid->analyz_2_staff,
            Carbon::parse($amnioticfluid->cyto_noti_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->cyto_noti_time)->format('H:i'),
            $amnioticfluid->cyto_noti_staff,
            Carbon::parse($amnioticfluid->report_date)->format('d/m/Y'),
            Carbon::parse($amnioticfluid->report_time)->format('H:i'),
            $amnioticfluid->report_staff,
            Carbon::parse($amnioticfluid->virified_date)->format('d/m/Y'),
            $amnioticfluid->virified_staff,
            Carbon::parse($amnioticfluid->email_date)->format('d/m/Y'),
            $amnioticfluid->email_staff,
            $amnioticfluid->all_remark,
        ] ;
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
            'ส่งต่อ QF-PCR',
            'วันที่ culture',
            'เวลา culture',
            'ผู้ปฏิบัติงาน',
            'วันที่ media',
            'เวลา media',
            'ผู้ปฏิบัติงาน',
            'วันที่ suculture_1',
            'เวลา suculture_1',
            'ผู้ปฏิบัติงาน',
            'วันที่ suculture_2',
            'เวลา suculture_2',
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
