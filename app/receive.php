<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receive extends Model
{
    protected $fillable = [
        'created_at',
        'chromo_name',
        'chromo_doc',
        'chromo_hos',
        'sample_type',
        'chromo_test',
        'rev_staff',
        'logis_staff',
        'report_date',
        'email_date',
        'chromo_number',
        'chromo_remark'       
    ];
}
