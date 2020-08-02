<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
@font-face{
 font-family:  'THSarabunNew';
 font-style: normal;
 font-weight: normal;
 src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
}
@font-face{
 font-family:  'THSarabunNew';
 font-style: normal;
 font-weight: bold;
 src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
}
@font-face{
 font-family:  'THSarabunNew';
 font-style: italic;
 font-weight: normal;
 src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
}
@font-face{
 font-family:  'THSarabunNew';
 font-style: italic;
 font-weight: bold;
 src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
}
body{
 font-family: "THSarabunNew";
 font-size: 1.2rem;
}
@page {
      size: A4;
      padding: 15px;
    }
    @media print {
      html, body {
        width: 210mm;
        height: 297mm;
        /*font-size : 16px;*/
      }
    }

    .table-bordered {
    border: 1px solid #dee2e6;
}
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}
table {
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #000;
}
.table-sm td, .table-sm th {
    padding: .25rem;
    vertical-align: middle;
}
</style>
  </head>
  <body>
    <table class="table table-bordered">
    <table id="patTable" class="table table-bordered table-sm ">
                <thead>
                    <tr>
                        <th colspan="2">รายการ</th>
                        <th>วันที่ปฏิบัติงาน</th>
                        <th>เวลาปฏิบัติงาน</th>
                        <th>ผู้ปฏิบัติงาน</th>
                        <th>หมายเหตุ</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td colspan="2"> Culture</td>
                        <td>@if (is_null($pdf_print->cult_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->cult_date))}} 
                           @endif
                        </td>
                        <td>@if (is_null($pdf_print->cult_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->cult_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->cult_staff}}</td>
                        <td>{{$pdf_print->cult_remark}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"> Media exchanged</td>
                        <td>@if (is_null($pdf_print->media_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->media_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->media_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->media_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->media_staff}}</td>
                        <td>{{$pdf_print->media_remark}}</td>
                    </tr>
                    <!-- row of subculture -->
                    <tr>
                        <td rowspan="2"> Subcuture</td>
                        <td>Flask1</td>
                        <td>@if (is_null($pdf_print->subcul1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->subcul1_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->subcul1_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->subcul1_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->subcul1_staff}}</td>
                        <td>{{$pdf_print->subcul1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td> @if (is_null($pdf_print->subcul2_date))
                           
                            @else
                            {{date('d-m-Y', strtotime($pdf_print->subcul2_date))}} </span>
                            @endif </td>
                        <td>@if (is_null($pdf_print->subcul2_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->subcul2_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->subcul2_staff}}</td>
                        <td>{{$pdf_print->subcul2_remark}}</td>
                    </tr>
                    <!-- end of subculture-->
                    <!-- row of Harvested -->
                    <tr>
                        <td rowspan="2"> Harvested</td>
                        <td>Flask1</td>
                        <td>@if (is_null($pdf_print->hvest_t1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->hvest_t1_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->hvest_t1_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->hvest_t1_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->hvest_t1_staff}}</td>
                        <td>{{$pdf_print->hvest_t1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($pdf_print->hvest_t2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->hvest_t2_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->hvest_t2_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->hvest_t2_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->hvest_t2_staff}}</td>
                        <td>{{$pdf_print->hvest_t2_remark}}</td>
                    </tr>
                    <!-- end of Harvested-->
                    <!-- row of Slide -->
                    <tr>
                        <td rowspan="2"> Slide Prepared</td>
                        <td>Flask1</td>
                        <td>@if (is_null($pdf_print->slide_t1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->slide_t1_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->slide_t1_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->slide_t1_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->slide_t1_staff}}</td>
                        <td>{{$pdf_print->slide_t1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($pdf_print->slide_t2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->slide_t2_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->slide_t2_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->slide_t2_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->slide_t2_staff}}</td>
                        <td>{{$pdf_print->slide_t2_remark}}</td>
                    </tr>
                    <!-- end of Slide-->
                    <!-- row of band -->
                    <tr>
                        <td rowspan="2"> Banding</td>
                        <td>Flask1</td>
                        <td>@if (is_null($pdf_print->band_t1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->band_t1_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->band_t1_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->band_t1_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->band_t1_staff}}</td>
                        <td>{{$pdf_print->band_t1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($pdf_print->band_t2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->band_t2_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->band_t2_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->band_t2_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->band_t2_staff}}</td>
                        <td>{{$pdf_print->band_t2_remark}}</td>
                    </tr>
                    <!-- end of band-->
                    <!-- row of Analyzed -->
                    <tr>
                        <td rowspan="2"> Analyzed</td>
                        <td>Flask1</td>
                        <td>@if (is_null($pdf_print->analyz_1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->analyz_1_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->analyz_1_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->analyz_1_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->analyz_1_staff}}</td>
                        <td>{{$pdf_print->analyz_1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($pdf_print->analyz_2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->analyz_2_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->analyz_2_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->analyz_2_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->analyz_2_staff}}</td>
                        <td>{{$pdf_print->analyz_2_remark}}</td>
                    </tr>
                    <!-- end of Analyzed-->
                    <!-- row of Cytogennetic -->
                    <tr>
                        <td colspan="2"> Cytogennetic Notification</td>
                        <td>@if (is_null($pdf_print->cyto_noti_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->cyto_noti_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->cyto_noti_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->cyto_noti_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->cyto_noti_staff}}</td>
                        <td>{{$pdf_print->cyto_noti_remark}}</td>
                    </tr>
                    <!-- end of Cytogennetic-->
                    <!-- row of report -->
                    <tr>
                        <td colspan="2"> reported</td>
                        <td>@if (is_null($pdf_print->report_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($pdf_print->report_date))}} 
                           @endif</td>
                        <td>@if (is_null($pdf_print->report_time))
                           
                           @else
                           {{date('H:i', strtotime($pdf_print->report_time))}} น.
                           @endif</td>
                        <td>{{$pdf_print->report_staff}}</td>
                        <td>{{$pdf_print->report_remark}}</td>
                    </tr>
                    <!-- end of report-->
                </tbody>
            </table>
  </body>
</html>