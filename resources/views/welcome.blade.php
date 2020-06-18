@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container">

    <p>เหลือน้ำคร่ำ : {{count($amniotic_no)}} ราย</p>
    <table id="patTable" class="table table-hover  ">
        <thead>
            <tr>
                <th>วันที่รับตัวอย่าง</th>
                <th>LabNumber</th>
                <th>ชื่อ-นามสกุล</th>
                <th>หน่วยงาน</th>
                <th>สิ่งส่งตรวจ</th>
                <th>รายการตรวจ</th>
                <th>ระยะเวลา</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chromoslast as $list)

            <tr>
                <td>{{$list->created_at->format('d/m/Y')}}</td>
                <td>{{$list->chromo_number}}</td>
                <td>{{$list->chromo_name}}</td>
                <td>{{$list->chromo_hos}}</td>
                <td> {{$list->sample_type}}

                </td>
                <td>

                    <?php
                    if($list['chromo_test']=="Karyotyping")
                        {echo "<span class='badge badge-pill badge-primary'>Karyotyping</span>";}
                          elseif($list['chromo_test']=="QF-PCR")
                            {echo "<span class='badge badge-pill badge-success'>QF-PCR</span>";}
                          elseif($list['chromo_test']=="Combo")
                            {echo "<span class='badge badge-pill badge-warning'>Combo</span>";}
                           
                  ?>
                </td>
                <td> {{\Carbon\Carbon::parse($list->created_at)->diffInDays()}} วัน</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection