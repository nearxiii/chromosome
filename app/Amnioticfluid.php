<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amnioticfluid extends Model
{
    protected $fillable = [
        'created_at','lab_no','pt_name','pt_add','sample_quelity','sample_con','cult_date','cult_time','cult_staff','cult_remark',
        'media_date','media_time','media_staff','media_remark','subcul1_date','subcul1_time','subcul1_staff','subcul1_remark','subcul2_date','subcul2_time',
        'subcul2_staff','subcul2_remark','hvest_t1_date','hvest_t1_time','hvest_t1_staff','hvest_t1_remark','hvest_t2_date','hvest_t2_time','hvest_t2_staff','hvest_t2_remark',
        'slide_t1_date','slide_t1_time','slide_t1_staff','slide_t1_remark','slide_t2_date','slide_t2_time','slide_t2_staff','slide_t2_remark','band_t1_date','band_t1_time',
        'band_t1_staff','band_t1_remark','band_t2_date','band_t2_time','band_t2_staff','band_t2_remark','analyz_1_date','analyz_1_time','analyz_1_staff','analyz_1_remark',
        'analyz_2_date','analyz_2_time','analyz_2_staff','analyz_2_remark','cyto_noti_date','cyto_noti_time','cyto_noti_staff','cyto_noti_remark','report_date','report_time',
        'report_staff','report_remark','virified_staff','virified_date','email_staff','email_date','all_remark','pcr_sent'
    ];
}
