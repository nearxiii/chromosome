@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container-md">

    @if(count($monthlysums)>0)
    <div class="row justify-content-end">
     <div class="col-sm-5">
        <form class="form-inline" action="{{ route('export.monthly') }}" method="GET">
            <div class="form-group my-3">
                        <select class="form-control " name="search_month" >
                            <option value="01" @if($monthly_fisrt->created_at->format('m')=="01")
                                                        selected='selected' @endif>มกราคม</option>
                            <option value="02" @if($monthly_fisrt->created_at->format('m')=="02")
                                                        selected='selected' @endif>กุมภาพันธ์</option>
                            <option value="03" @if($monthly_fisrt->created_at->format('m')=="03")
                                                        selected='selected' @endif>มีนาคม</option>
                            <option value="04" @if($monthly_fisrt->created_at->format('m')=="04")
                                                        selected='selected' @endif>เมษายน</option>
                            <option value="05" @if($monthly_fisrt->created_at->format('m')=="05")
                                                        selected='selected' @endif>พฤษภาคม</option>
                            <option value="06" @if($monthly_fisrt->created_at->format('m')=="06")
                                                        selected='selected' @endif>มิถุนายน</option>
                            <option value="07" @if($monthly_fisrt->created_at->format('m')=="07")
                                                        selected='selected' @endif>กรกฎาคม</option>
                            <option value="08" @if($monthly_fisrt->created_at->format('m')=="08")
                                                        selected='selected' @endif>สิงหาคม</option>
                            <option value="09" @if($monthly_fisrt->created_at->format('m')=="09")
                                                        selected='selected' @endif>กันยายน</option>
                            <option value="10" @if($monthly_fisrt->created_at->format('m')=="10")
                                                        selected='selected' @endif>ตุลาคม</option>
                            <option value="11" @if($monthly_fisrt->created_at->format('m')=="11")
                                                        selected='selected' @endif>พฤศจิกายน</option>
                            <option value="12" @if($monthly_fisrt->created_at->format('m')=="12")
                                                        selected='selected' @endif>ธันวาคม</option>
                        </select>
            </div>
            <div class="form-group mx-sm-3 my-3">
                <input type="text" class="form-control" name="search_years" 
                        value="{{ ($monthly_fisrt->created_at->format('Y'))}}" />
            </div>
            <div class="form-group mx-sm-3 my-3">
            <button type="submit" class="btn btn-success btn-block ">Download</button>
            </div>
           
        </form>
        </div>
        @include('sumary.tablemonthly', $monthlysums)




    </div>
    @elseif(count($monthlysums)==0)
    <div class="row text-center  justify-content-center mt-4 mb-3">
    <h2 >สรุปจำนวนตามเดือน</h2> 
    
    </div>
    <div class="row text-center  justify-content-center mt-4 mb-3">
    <h5 class="mb-3">เลือกเดือนและปีที่ต้องการสรุป</h5>
        <div class="col-md-12  ">
            <form action="{{ route('monthly.filter') }}" method="GET">
                <div class="input-group  text-center  justify-content-center">

                    <div class="col-sm-2">
                        <select class="form-control lab_name" name="search_month" id="search">
                            <option value=" ">เลือกเดือน</option>
                            <option value="01">มกราคม</option>
                            <option value="02">กุมภาพันธ์</option>
                            <option value="03">มีนาคม</option>
                            <option value="04">เมษายน</option>
                            <option value="05">พฤษภาคม</option>
                            <option value="06">มิถุนายน</option>
                            <option value="07">กรกฎาคม</option>
                            <option value="08">สิงหาคม</option>
                            <option value="09">กันยายน</option>
                            <option value="10">ตุลาคม</option>
                            <option value="11">พฤศจิกายน</option>
                            <option value="12">ธันวาคม</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control lab_name" name="search_years" id="search">
                            <option value=" ">เลือกปี</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary btn-block ">สรุป</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @endif
</div>

@endsection