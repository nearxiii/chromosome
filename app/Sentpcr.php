<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentpcr extends Model
{
    protected $fillable = [
        'created_at',
        'lab_no',
        'pt_name',
        'pt_add',
        'sample_quelity',
        'sample_con',
        'dna_conc',
        'dna_date',
        'dna_time',
        'dna_staff',
        'dna_remark',
        'pcr_conc',
        'pcr_date',
        'pcr_time',
        'pcr_staff',
        'pcr_remark',
        'frag_conc',
        'frag_date',
        'frag_time',
        'frag_staff',
        'frag_remark',
        'dilute_fac',
        'analyz_staff',
        'analyz_date',
        'virified_staff',
        'virified_date',
        'email_staff',
        'email_date',
        'remark',
        'pcr_result'
    ];
}
