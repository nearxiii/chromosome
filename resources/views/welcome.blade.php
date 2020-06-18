@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container">
<div class="row mt-4 justify-content-center">
<div class="col-auto text-center">
<h2>รายการตรวจวิเคราะห์โครโมโซม</h2>
<h4>@php
                                $dt = \Carbon\Carbon::now();

                                function DateThai($strDate)
                                {
                                $strYear = date("Y",strtotime($strDate))+543;
                                $strMonth= date("n",strtotime($strDate));
                                $strDay= date("j",strtotime($strDate));
                                $strHour= date("H",strtotime($strDate));
                                $strMinute= date("i",strtotime($strDate));
                                $strSeconds= date("s",strtotime($strDate));
                                $strMonthCut = Array("","มกราคม
                                ","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                                $strMonthThai=$strMonthCut[$strMonth];
                                return "$strDay $strMonthThai $strYear";
                                }

                                $strDate = \Carbon\Carbon::now();
                                echo DateThai($strDate);
                                @endphp </h4><h5><div id="MyClockDisplay" class="clock "></div></h5>
                                
</div></div>
<div class="row">
<div class="col-md-4">
<div class="card m-3">
  <div class="card-body text-center">
  <h3>น้ำคร่ำ</h3>
  <p class="display-xl">{{count($amniotic_no)}}</p> 
  
  </div>
</div>
</div>
<div class="col-md-4">
<div class="card m-3">
  <div class="card-body text-center">
  <h3>เลือด</h3>
  <p class="display-xl">{{count($blood_no)}}</p> 
  
  </div>
</div>
</div>
<div class="col-md-4">
<div class="card m-3">
  <div class="card-body text-center">
  <h3>QF-PCR</h3>
  <p class="display-xl">{{count($pcr_no)}}</p> 
  
  </div>
</div>
</div>
</div>
    
    <table id="patTable" class="table table-hover  ">
        <thead>
            <tr>
                <th>วันที่รับตัวอย่าง</th>
                <th>LabNumber</th>
                <th>ชื่อ-นามสกุล</th>
                <th>หน่วยงาน</th>
                <th>สิ่งส่งตรวจ</th>
                <th>รายการตรวจ</th>
                <th class="text-center">ระยะเวลา</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chromoslast as $list)

            <tr>
                <td>{{$list->created_at->format('d/m/Y')}}</td>
                <td>{{$list->chromo_number}}</td>
                <td>{{$list->chromo_name}}</td>
                <td>{{$list->chromo_hos}}</td>
                <td> <?php
                    if($list['sample_type']=="เลือด")
                        {echo "<span class='dot'></span> เลือด";}
                          elseif($list['sample_type']=="น้ำคร่ำ")
                            {echo "<span class='dot-y'></span> น้ำคร่ำ";}
                          
                  ?>

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
                <td class="text-danger text-center"> <b>{{\Carbon\Carbon::parse($list->created_at)->diffInDays()}} วัน</b></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript">
    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";

        if (h >= 12) {
            h = h - 12;
            session = "PM";
        }

        if (h == 0) {
            h = 12;
        }


        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);
    }

    showTime();
    </script>

@endsection