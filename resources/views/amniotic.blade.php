@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container">

    <div class="row">

        <div class="col-sm-8  mt-4 mb-4">
            <h3 class="d-inline-block align-middle">รายการรับแลบโครโมโซม</h3>
        </div>
        <div class="col-sm-4 mb-4 mt-4">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal"><i
                    class="fas fa-plus"></i>
                ลงทะเบียนรับสิ่งส่งตรวจ
            </button>
        </div>

        <div class="col-sm-12">
            @if(session()->get('success'))
            <script>
            Swal.fire({
                type: 'success',
                title: "{{ session('success') }}"
            });
            </script>
            <!-- <div class="alert alert-success">
                {{ session()->get('success') }}  
                </div> -->
            @endif

        </div>
        @if ($errors->any())
        <div class="alert alert-danger col-sm-12">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
    </div>


    <!-- Modal add-->
    <div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-success" style="margin: 0 auto; " id="addModalLabel">
                        ลงทะเบียนรับสิ่งส่งตรวจ</h3>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 offset-sm-1">


                            <form method="post" action="{{ route('amniotic.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label><b>วันที่รับสิ่งส่งตรวจ</b> </label>
                                    <input type="date" class="form-control" name="created_at"
                                        value="<?php echo date("Y-m-d");?>" placeholder="วันที่" /></div>
                                <div class="form-group lab_name">
                                    <select class="form-control select_name" style="width: 100%" name="pt_name"
                                        id="lab_name">
                                        <option value="">ค้นรายชื่อ</option>
                                        @foreach($namelist as $key )
                                        <option value="{{$key->chromo_name}}" data-price="{{$key->chromo_number}}"
                                            data-add="{{$key->chromo_hos}}">
                                            {{$key->chromo_name}} ( {{$key->chromo_number}} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control lab_no" name="lab_no" placeholder="Labnumber"
                                        required readonly />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control lab_add" name="pt_add" placeholder="หน่วยงาน"
                                        required readonly />
                                </div>
                                <label><b> ปริมาณตะกอน</b></label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline pr-5">
                                        <input class="form-check-input" type="checkbox" id="qulti1" value="น้อย"
                                            name="sample_quelity">
                                        <label class="form-check-label" for="qulti1">น้อย</label>
                                    </div>
                                    <div class="form-check form-check-inline pr-5">
                                        <input class="form-check-input" type="checkbox" id="qulti2" value="ปานกลาง"
                                            name="sample_quelity">
                                        <label class="form-check-label" for="qulti2">ปานกลาง</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="qulti3" value="มาก"
                                            name="sample_quelity">
                                        <label class="form-check-label" for="qulti3">มาก</label>
                                    </div>
                                </div>
                                <label><b> การปนเปื้อนเลือด</b></label>
                                <div class="form-group">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="con1" value="ไม่มี"
                                            name="sample_con[]">
                                        <label class="form-check-label" for="con1">ไม่มี</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="con2" value="มี"
                                            name="sample_con[]">
                                        <label class="form-check-label" for="con2">มี</label>
                                    </div>

                                    <label class="pr-3"><b> ปริมาณ</b></label>

                                    <div class="form-check form-check-inline pr-3">
                                        <input class="form-check-input" type="checkbox" id="conq1" value="น้อย"
                                            name="sample_con[]">
                                        <label class="form-check-label" for="conq1">น้อย</label>
                                    </div>
                                    <div class="form-check form-check-inline pr-3">
                                        <input class="form-check-input" type="checkbox" id="conq2" value="ปานกลาง"
                                            name="sample_con[]">
                                        <label class="form-check-label" for="conq2">ปานกลาง</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="conq3" value="มาก"
                                            name="sample_con[]">
                                        <label class="form-check-label" for="conq3">มาก</label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit"
                                        class="btn btn-success btn-lg btn-block ">บันทึก</button><br />

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end moal add -->

    <div class="row mb-3 ">
        <div class="col-sm-1 "></div>
        <div class="col-2"><b> วันที่รับตัวอย่าง</b></div>
        <div class="col-2"><b> LabNumber</b></div>
        <div class="col-2"><b> ชื่อ-นามสกุล</b></div>
        <div class="col-2"><b> หน่วยงาน</b></div>
        <div class="col-2"><b> สถานะ</b></div>
        <div class="col-1"><b> Actions</b></div>
    </div>
    @foreach($amniotic as $amniotics)
    <div class="card mb-2 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-1 "><button class="btn btn-sm btn-outline-toglle togle_subtable"
                        id="{{$amniotics->id}}"><i class="fas fa-angle-down"></i></button></div>
                <div class="col-2">{{$amniotics->created_at->format('d/m/Y')}}</div>
                <div class="col-2">{{$amniotics->lab_no}}</div>
                <div class="col-2">{{$amniotics->pt_name}}</div>
                <div class="col-2">{{$amniotics->pt_add}}</div>
                <div class="col-2">
                @if (is_null($amniotics->pcr_sent))
                    @if (is_null($amniotics->email_date))
                        @if (is_null($amniotics->cult_date))
                            
                        @else
                        <span class="badge badge-primary">C</span> 
                        @endif
                        @if (is_null($amniotics->media_date))
                            
                        @else
                        <span class="badge badge-primary">M</span> 
                        @endif
                        @if (is_null($amniotics->subcul1_date))
                            
                        @else
                        <span class="badge badge-primary">S</span> 
                        @endif
                        @if (is_null($amniotics->hvest_t1_date))
                            
                        @else
                        <span class="badge badge-primary">H</span> 
                        @endif
                        @if (is_null($amniotics->slide_t1_date))
                            
                        @else
                        <span class="badge badge-primary">SL</span> 
                        @endif
                        @if (is_null($amniotics->band_t1_date))
                            
                        @else
                        <span class="badge badge-primary">B</span> 
                        @endif
                        @if (is_null($amniotics->analyz_1_date))
                            
                        @else
                        <span class="badge badge-primary">A</span> 
                        @endif
                        @if (is_null($amniotics->cyto_noti_date))
                            
                        @else
                        <span class="badge badge-primary">CY</span> 
                        @endif
                        @if (is_null($amniotics->report_date))
                            
                        @else
                        <span class="badge badge-primary">R</span> 
                        @endif
                    @else
                    <span class="badge badge-pill badge-success">ส่งผลแล้ว</span>  
                    @endif  
                @else
                <span class="badge badge-pill badge-warning">ส่งต่อ QF-PCR </span>
                @endif
                </div>
                <div class="col-1">
                    <div class="row">
                        <div class="col-sm"><a href="#" class="btn btn-sm btn-outline-toglle" data-toggle="modal"
                                data-target="#editModal{{ $amniotics->id }}"><i class="far fa-edit"></i></a></div>
                        <div class="col-sm"><a href="{{ route('amniotic.edit',$amniotics->id)}}"
                                class="btn btn-sm btn-outline-toglle"><i class="fas fa-sign-out-alt"></i></a>
                        </div>
                        <div class="col-sm"><a href="#" class="btn btn-sm btn-outline-toglle-del" data-toggle="modal"
                                data-target="#"><i class="far fa-trash-alt"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body mx-3 sub_table{{$amniotics->id}} hid_sub">
            <p>ปริมาณตะกอน&nbsp; <b>{{$amniotics->sample_quelity}}</b> , การปนเปื้อนเลือด&nbsp;<b>
                    {{$amniotics->sample_con}}</b></p>
            <table id="patTable" class="table table-bordered table-sm  ">
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
                        <td>@if (is_null($amniotics->cult_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->cult_date))}} 
                           @endif
                        </td>
                        <td>@if (is_null($amniotics->cult_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->cult_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->cult_staff}}</td>
                        <td>{{$amniotics->cult_remark}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"> Media exchanged</td>
                        <td>@if (is_null($amniotics->media_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->media_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->media_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->media_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->media_staff}}</td>
                        <td>{{$amniotics->media_remark}}</td>
                    </tr>
                    <!-- row of subculture -->
                    <tr>
                        <td rowspan="2"> Subcuture</td>
                        <td>Flask1</td>
                        <td>@if (is_null($amniotics->subcul1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->subcul1_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->subcul1_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->subcul1_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->subcul1_staff}}</td>
                        <td>{{$amniotics->subcul1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td> @if (is_null($amniotics->subcul2_date))
                           
                            @else
                            {{date('d-m-Y', strtotime($amniotics->subcul2_date))}} </span>
                            @endif </td>
                        <td>@if (is_null($amniotics->subcul2_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->subcul2_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->subcul2_staff}}</td>
                        <td>{{$amniotics->subcul2_remark}}</td>
                    </tr>
                    <!-- end of subculture-->
                    <!-- row of Harvested -->
                    <tr>
                        <td rowspan="2"> Harvested</td>
                        <td>Flask1</td>
                        <td>@if (is_null($amniotics->hvest_t1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->hvest_t1_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->hvest_t1_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->hvest_t1_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->hvest_t1_staff}}</td>
                        <td>{{$amniotics->hvest_t1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($amniotics->hvest_t2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->hvest_t2_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->hvest_t2_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->hvest_t2_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->hvest_t2_staff}}</td>
                        <td>{{$amniotics->hvest_t2_remark}}</td>
                    </tr>
                    <!-- end of Harvested-->
                    <!-- row of Slide -->
                    <tr>
                        <td rowspan="2"> Slide Prepared</td>
                        <td>Flask1</td>
                        <td>@if (is_null($amniotics->slide_t1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->slide_t1_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->slide_t1_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->slide_t1_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->slide_t1_staff}}</td>
                        <td>{{$amniotics->slide_t1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($amniotics->slide_t2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->slide_t2_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->slide_t2_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->slide_t2_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->slide_t2_staff}}</td>
                        <td>{{$amniotics->slide_t2_remark}}</td>
                    </tr>
                    <!-- end of Slide-->
                    <!-- row of band -->
                    <tr>
                        <td rowspan="2"> Banding</td>
                        <td>Flask1</td>
                        <td>@if (is_null($amniotics->band_t1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->band_t1_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->band_t1_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->band_t1_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->band_t1_staff}}</td>
                        <td>{{$amniotics->band_t1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($amniotics->band_t2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->band_t2_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->band_t2_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->band_t2_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->band_t2_staff}}</td>
                        <td>{{$amniotics->band_t2_remark}}</td>
                    </tr>
                    <!-- end of band-->
                    <!-- row of Analyzed -->
                    <tr>
                        <td rowspan="2"> Analyzed</td>
                        <td>Flask1</td>
                        <td>@if (is_null($amniotics->analyz_1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->analyz_1_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->analyz_1_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->analyz_1_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->analyz_1_staff}}</td>
                        <td>{{$amniotics->analyz_1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($amniotics->analyz_2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->analyz_2_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->analyz_2_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->analyz_2_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->analyz_2_staff}}</td>
                        <td>{{$amniotics->analyz_2_remark}}</td>
                    </tr>
                    <!-- end of Analyzed-->
                    <!-- row of Cytogennetic -->
                    <tr>
                        <td colspan="2"> Cytogennetic Notification</td>
                        <td>@if (is_null($amniotics->cyto_noti_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->cyto_noti_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->cyto_noti_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->cyto_noti_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->cyto_noti_staff}}</td>
                        <td>{{$amniotics->cyto_noti_remark}}</td>
                    </tr>
                    <!-- end of Cytogennetic-->
                    <!-- row of report -->
                    <tr>
                        <td colspan="2"> reported</td>
                        <td>@if (is_null($amniotics->report_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($amniotics->report_date))}} 
                           @endif</td>
                        <td>@if (is_null($amniotics->report_time))
                           
                           @else
                           {{date('H:i', strtotime($amniotics->report_time))}} น.
                           @endif</td>
                        <td>{{$amniotics->report_staff}}</td>
                        <td>{{$amniotics->report_remark}}</td>
                    </tr>
                    <!-- end of report-->
                </tbody>
            </table>
            <div class="row">
                <div class="col-11">
                    <p>Karyotype Result&nbsp;&nbsp;&nbsp;&nbsp; <b> {{$amniotics->karyo_result}}</b></p>
                    <p>Verified & Print By &nbsp;&nbsp;&nbsp;&nbsp;<b>{{$amniotics->virified_staff}} </b>&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($amniotics->virified_date))
                           
                           @else
                           <b>{{date('d-m-Y', strtotime($amniotics->virified_date))}}</b> 
                           @endif</p>
                    <p>E-mail sent By &nbsp;&nbsp;&nbsp;&nbsp;<b>{{$amniotics->email_staff}} </b>&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($amniotics->email_date))
                           
                           @else
                           <b>{{date('d-m-Y', strtotime($amniotics->email_date))}} </b>
                           @endif</p>
                    <p>หมายเหตุ&nbsp;&nbsp;&nbsp;&nbsp; <b>{{$amniotics->all_remark}}</b></p>
                </div>
                <div class="col-1">
                    <a href="" class="btn  btn-light"><i class="fas fa-print"></i> Print</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-->
    <div class="modal fade" id="editModal{{ $amniotics->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-success" style="margin: 0 auto; " id="addModalLabel">
                        อัพเดทสถานะการส่งผล</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 offset-sm-1">

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                            @endif
                            <p> ชื่อ - สกุล : <b>{{$amniotics->pt_name}}</b><br>
                                หน่วยงาน :<b> {{$amniotics->pt_add}}</b></p>
                            <form method="post" action="{{ route('amniotic.update', $amniotics->id) }}">
                                @method('PATCH')
                                @csrf
                                <table id="patTable" class="table table-bordered table-sm  ">
                                    <thead>
                                        <tr>
                                            <th colspan="2">รายการ</th>
                                            <th>วันที่ปฏิบัติงาน</th>
                                            <th>เวลาปฏิบัติงาน</th>
                                            <th width="20%">ผู้ปฏิบัติงาน</th>
                                            <th>หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td colspan="2"><b> Culture</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="{{ $amniotics->cult_date }}" name="cult_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $amniotics->cult_time }}" name="cult_time" /></td>
                                            <td>
                                                <select class="form-control form-control-sm" name="cult_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->cult_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->cult_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->cult_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="cult_remark" value="{{ $amniotics->cult_remark }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> <b>Media exchanged</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="{{ $amniotics->media_date }}" name="media_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $amniotics->media_time }}" name="media_time" /></td>
                                            <td><select class="form-control form-control-sm" name="media_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->media_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->media_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->media_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="media_remark"  value="{{ $amniotics->media_remark }}"/></td>
                                        </tr>
                                        <!-- row of subculture -->
                                        <tr>
                                            <td rowspan="2"><b> Subcuture</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->subcul1_date }}"    name="subcul1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->subcul1_time }}"   name="subcul1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="subcul1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->subcul1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->subcul1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->subcul1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="subcul1_remark"  value="{{ $amniotics->subcul1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->subcul2_date }}"    name="subcul2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->subcul2_time }}"    name="subcul2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="subcul2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->subcul2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->subcul2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->subcul2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="subcul2_remark" value="{{ $amniotics->subcul2_remark }}"/></td>
                                        </tr>
                                        <!-- end of subculture-->
                                        <!-- row of Harvested -->
                                        <tr>
                                            <td rowspan="2"><b> Harvested</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->hvest_t1_date }}"    name="hvest_t1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->hvest_t1_time }}"    name="hvest_t1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="hvest_t1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->hvest_t1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->hvest_t1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->hvest_t1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="hvest_t1_remark" value="{{ $amniotics->hvest_t1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->hvest_t2_date }}"    name="hvest_t2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->hvest_t2_time }}"    name="hvest_t2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="hvest_t2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->hvest_t2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->hvest_t2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->hvest_t2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="hvest_t2_remark" value="{{ $amniotics->hvest_t2_remark }}"/></td>
                                        </tr>
                                        <!-- end of Harvested-->
                                        <!-- row of Slide -->
                                        <tr>
                                            <td rowspan="2"><b> Slide Prepared</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->slide_t1_date }}"     name="slide_t1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->slide_t1_time }}"     name="slide_t1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="slide_t1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->slide_t1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->slide_t1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->slide_t1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="slide_t1_remark" value="{{ $amniotics->slide_t1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->slide_t2_date }}"     name="slide_t2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->slide_t2_time }}"    name="slide_t2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="slide_t2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->slide_t2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์"  @if($amniotics->slide_t2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา"  @if($amniotics->slide_t2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="slide_t2_remark" value="{{ $amniotics->slide_t2_remark }}" /></td>
                                        </tr>
                                        <!-- end of Slide-->
                                        <!-- row of band -->
                                        <tr>
                                            <td rowspan="2"><b> Banding</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->band_t1_date }}"    name="band_t1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->band_t1_time }}"    name="band_t1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="band_t1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->band_t1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์"  @if($amniotics->band_t1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา"  @if($amniotics->band_t1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="band_t1_remark" value="{{ $amniotics->band_t1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->band_t2_date }}"    name="band_t2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->band_t2_time }}"     name="band_t2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="band_t2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->band_t2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->band_t2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->band_t2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="band_t2_remark" value="{{ $amniotics->band_t2_remark }}"/></td>
                                        </tr>
                                        <!-- end of band-->
                                        <!-- row of Analyzed -->
                                        <tr>
                                            <td rowspan="2"><b> Analyzed</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->analyz_1_date }}"    name="analyz_1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->analyz_1_time }}"    name="analyz_1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="analyz_1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->analyz_1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->analyz_1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->analyz_1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="analyz_1_remark" value="{{ $amniotics->analyz_1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->analyz_2_date }}"    name="analyz_2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->analyz_2_time }}"    name="analyz_2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="analyz_2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->analyz_2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->analyz_2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->analyz_2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="analyz_2_remark" value="{{ $amniotics->analyz_2_remark }}"/></td>
                                        </tr>
                                        <!-- end of Analyzed-->
                                        <!-- row of Cytogennetic -->
                                        <tr>
                                            <td colspan="2"><b> Cytogennetic Notification</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->cyto_noti_date }}"    name="cyto_noti_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->cyto_noti_time }}"     name="cyto_noti_time" /></td>
                                            <td><select class="form-control form-control-sm" name="cyto_noti_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($amniotics->cyto_noti_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->cyto_noti_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->cyto_noti_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="cyto_noti_remark" value="{{ $amniotics->cyto_noti_remark }}"/></td>
                                        </tr>
                                        <!-- end of Cytogennetic-->
                                        <!-- row of report -->
                                        <tr>
                                            <td colspan="2"><b> reported</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $amniotics->report_date }}"     name="report_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $amniotics->report_time }}"    name="report_time" /></td>
                                            <td><select class="form-control form-control-sm" name="report_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์"@if($amniotics->report_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($amniotics->report_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($amniotics->report_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="report_remark" value="{{ $amniotics->report_remark }}"/></td>
                                        </tr>
                                        <!-- end of report-->
                                    </tbody>
                                </table>
                                <div class="row mb-3">
                                    <div class="col-md-3 align-middle">
                                        <label>Karyotype Result</label>
                                        <input type="text" class="form-control form-control-sm" name="karyo_result"
                                            placeholder="ผล Karyotype" value="{{ $amniotics->karyo_result }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>Verified & Printed </label>
                                        <select class="form-control form-control-sm " name="virified_staff">
                                            <option value="">ผู้ออกผล</option>
                                            <option value="อมรรัตน์" @if($amniotics->virified_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                            <option value="ชัชวิชญ์" @if($amniotics->virified_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                            <option value="ฉัตรลดา" @if($amniotics->virified_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                        </select>
                                        <div class="mt-2">วันที่ออกผล </div>
                                        <input type="date" class="form-control form-control-sm" name="virified_date" value="{{ $amniotics->virified_date }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>E-mail sent </label>
                                        <select class="form-control form-control-sm " name="email_staff">
                                            <option value="">ผู้ส่ง</option>
                                            <option value="อมรรัตน์" @if($amniotics->email_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                            <option value="ชัชวิชญ์"  @if($amniotics->email_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                            <option value="ฉัตรลดา"  @if($amniotics->email_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                        </select>
                                        <div class="mt-2">วันที่ส่ง </div>
                                        <input type="date" class="form-control form-control-sm" name="email_date" value="{{ $amniotics->email_date }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>หมายเหตุ </label>
                                        <input type="text" class="form-control form-control-sm mb-3" name="all_remark"
                                            placeholder="หมายเหตุ" value="{{ $amniotics->all_remark }}" />
                                        <div class="alert alert-warning" role="alert">
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" name="pcr_sent"
                                                    id="exampleRadios1" value="ส่งต่อ QF-PCR">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    ส่งต่อ QF-PCR
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer mx-5 justify-content-center">
                                    <button type="submit" class="btn btn-success btn-lg "
                                        style="width: 200px;">บันทึก</button><br />
                                    <button type="button" class="btn btn-danger btn-lg btn-block" style="width: 200px;"
                                        data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end moal add -->
    @endforeach



</div>
<script>
$('.lab_name').on('change', function() {
    $('.lab_no')
        .val(
            $(this).find(':selected').data('price')
        );
    $('.lab_add')
        .val(
            $(this).find(':selected').data('add')
        );
});

$(document).ready(function() {
    $('.select_name').select2();
    $('.hid_sub').hide();
    $('.togle_subtable').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        $('.sub_table' + id).toggle();
    });

});
</script>
@endsection