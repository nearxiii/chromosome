@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container">

    <div class="row">

        <div class="col-sm-4  mt-4 mb-4">
            <h3 class="d-inline-block align-middle">บันทึกรายการตรวจเลือด</h3>
        </div>
        <div  class=" col-sm-5 mb-4 mt-4">
        
            <form action="findbloods" class="form-inline" method="GET">
            
            <input type="text" class="form-control " style="width: 70%;" name="search_name" placeholder="ค้นชื่อ-สกุล" />
            
            
            <button type="submit" class="btn btn-outline-primary ml-3">ค้นหา</button>
            
        </form>
        </div>
        <div class="col-sm-3 mb-4 mt-4">
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 offset-sm-1">
                            <form method="post" action="{{ route('bloods.store') }}">
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
                                <label><b> ลักษณะ</b></label>
                                <div class="form-group">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="qulti1" value="Normal"
                                            name="sample_quelity">
                                        <label class="form-check-label" for="qulti1">Normal</label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="qulti2" value="Complete hemolysis"
                                            name="sample_quelity">
                                        <label class="form-check-label" for="qulti2">Complete hemolysis</label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="qulti3" value="Partial hemolysis"
                                            name="sample_quelity">
                                        <label class="form-check-label" for="qulti3">Partial hemolysis</label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="qulti4" value="Complete clot"
                                            name="sample_quelity">
                                        <label class="form-check-label" for="qulti4">Complete clot</label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="qulti5" value="Partial clot"
                                            name="sample_quelity">
                                        <label class="form-check-label" for="qulti5">Partial clot</label>
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
    @foreach($bloods as $blood)
    <div  @if (is_null($blood->pcr_sent))
                    @if (is_null($blood->email_date))
                        @if (is_null($blood->report_date))
                            @if (is_null($blood->cyto_noti_date))
                                @if (is_null($blood->analyz_2_date))
                                    @if (is_null($blood->band_t2_date))
                                        @if (is_null($blood->slide_t2_date))
                                            @if (is_null($blood->hvest_t2_date))
                                                @if (is_null($blood->subcul2_date))
                                                    @if (is_null($blood->media_date))
                                                        @if (is_null($blood->cult_date))
                                                        class="card-danger mb-2 shadow-sm"
                                                        @else
                                                        class="card-primary mb-2 shadow-sm"
                                                        @endif
                                                    @else
                                                    class="card-primary mb-2 shadow-sm"
                                                    @endif 
                                                @else
                                                class="card-primary mb-2 shadow-sm"
                                                @endif 
                                            @else
                                            class="card-primary mb-2 shadow-sm"
                                            @endif 
                                        @else
                                        class="card-primary mb-2 shadow-sm"
                                        @endif 
                                    @else
                                    class="card-primary mb-2 shadow-sm"
                                    @endif 
                                @else
                                class="card-primary mb-2 shadow-sm"
                                @endif 
                            @else
                            class="card-primary mb-2 shadow-sm"
                            @endif 
                        @else
                        class="card-primary mb-2 shadow-sm"
                        @endif
                    @else
                    class="card-success mb-2 shadow-sm"
                    @endif  
                @else
                class="card-warning mb-2 shadow-sm"
                @endif>
        <div class="card-body">
        
            <div class="row">
                <div class="col-sm-1 "><button class="btn btn-sm btn-outline-toglle togle_subtable"
                        id="{{$blood->id}}"><i class="fas fa-angle-down"></i></button></div>
                <div class="col-2">{{$blood->created_at->format('d/m/Y')}}</div>
                <div class="col-2">{{$blood->lab_no}}</div>
                <div class="col-2">{{$blood->pt_name}}</div>
                <div class="col-2">{{$blood->pt_add}}</div>
                <div class="col-2">
                @if (is_null($blood->pcr_sent))
                    @if (is_null($blood->email_date))
                        @if (is_null($blood->report_date))
                            @if (is_null($blood->cyto_noti_date))
                                @if (is_null($blood->analyz_2_date))
                                    @if (is_null($blood->band_t2_date))
                                        @if (is_null($blood->slide_t2_date))
                                            @if (is_null($blood->hvest_t2_date))
                                                @if (is_null($blood->subcul2_date))
                                                    @if (is_null($blood->media_date))
                                                        @if (is_null($blood->cult_date))
                                                        <span class="badge  badge-pill badge-danger">รอตรวจ</span> 
                                                        @else
                                                        <span class="badge  badge-pill badge-primary">Culture</span> 
                                                        @endif
                                                    @else
                                                    <span class="badge  badge-pill badge-primary">Media exchanged</span> 
                                                    @endif 
                                                @else
                                                <span class="badge  badge-pill badge-primary">Subcuture</span> 
                                                @endif 
                                            @else
                                            <span class="badge  badge-pill badge-primary">Harvested</span> 
                                            @endif 
                                        @else
                                        <span class="badge  badge-pill badge-primary">Slide Prepared</span> 
                                        @endif 
                                    @else
                                    <span class="badge  badge-pill badge-primary">Banding</span> 
                                    @endif 
                                @else
                                <span class="badge  badge-pill badge-primary">Analyzed</span> 
                                @endif 
                            @else
                            <span class="badge  badge-pill badge-primary">Cytogennetic</span> 
                            @endif 
                        @else
                        <span class="badge badge-pill badge-primary">Reported</span> 
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
                                data-target="#editModal{{ $blood->id }}"><i class="far fa-edit"></i></a></div>
                        <div class="col-sm"><a href="{{ route('bloods.edit',$blood->id)}}"
                                class="btn btn-sm btn-outline-toglle"><i class="fas fa-sign-out-alt"></i></a>
                        </div>
                        <div class="col-sm"><a href="#" class="btn btn-sm btn-outline-toglle-del" data-toggle="modal"
                                data-target="#"><i class="far fa-trash-alt"></i></a></div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="card-body mx-3 sub_table{{$blood->id}} hid_sub">
            <p>ปริมาณตะกอน&nbsp; <b>{{$blood->sample_quelity}}</b> , การปนเปื้อนเลือด&nbsp;<b>
                    {{$blood->sample_con}}</b></p>
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
                        <td>@if (is_null($blood->cult_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->cult_date))}} 
                           @endif
                        </td>
                        <td>@if (is_null($blood->cult_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->cult_time))}} น.
                           @endif</td>
                        <td>{{$blood->cult_staff}}</td>
                        <td>{{$blood->cult_remark}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"> Media exchanged</td>
                        <td>@if (is_null($blood->media_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->media_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->media_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->media_time))}} น.
                           @endif</td>
                        <td>{{$blood->media_staff}}</td>
                        <td>{{$blood->media_remark}}</td>
                    </tr>
                    <!-- row of subculture -->
                    <tr>
                        <td rowspan="2"> Subcuture</td>
                        <td>Flask1</td>
                        <td>@if (is_null($blood->subcul1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->subcul1_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->subcul1_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->subcul1_time))}} น.
                           @endif</td>
                        <td>{{$blood->subcul1_staff}}</td>
                        <td>{{$blood->subcul1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td> @if (is_null($blood->subcul2_date))
                           
                            @else
                            {{date('d-m-Y', strtotime($blood->subcul2_date))}} </span>
                            @endif </td>
                        <td>@if (is_null($blood->subcul2_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->subcul2_time))}} น.
                           @endif</td>
                        <td>{{$blood->subcul2_staff}}</td>
                        <td>{{$blood->subcul2_remark}}</td>
                    </tr>
                    <!-- end of subculture-->
                    <!-- row of Harvested -->
                    <tr>
                        <td rowspan="2"> Harvested</td>
                        <td>Flask1</td>
                        <td>@if (is_null($blood->hvest_t1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->hvest_t1_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->hvest_t1_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->hvest_t1_time))}} น.
                           @endif</td>
                        <td>{{$blood->hvest_t1_staff}}</td>
                        <td>{{$blood->hvest_t1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($blood->hvest_t2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->hvest_t2_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->hvest_t2_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->hvest_t2_time))}} น.
                           @endif</td>
                        <td>{{$blood->hvest_t2_staff}}</td>
                        <td>{{$blood->hvest_t2_remark}}</td>
                    </tr>
                    <!-- end of Harvested-->
                    <!-- row of Slide -->
                    <tr>
                        <td rowspan="2"> Slide Prepared</td>
                        <td>Flask1</td>
                        <td>@if (is_null($blood->slide_t1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->slide_t1_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->slide_t1_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->slide_t1_time))}} น.
                           @endif</td>
                        <td>{{$blood->slide_t1_staff}}</td>
                        <td>{{$blood->slide_t1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($blood->slide_t2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->slide_t2_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->slide_t2_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->slide_t2_time))}} น.
                           @endif</td>
                        <td>{{$blood->slide_t2_staff}}</td>
                        <td>{{$blood->slide_t2_remark}}</td>
                    </tr>
                    <!-- end of Slide-->
                    <!-- row of band -->
                    <tr>
                        <td rowspan="2"> Banding</td>
                        <td>Flask1</td>
                        <td>@if (is_null($blood->band_t1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->band_t1_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->band_t1_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->band_t1_time))}} น.
                           @endif</td>
                        <td>{{$blood->band_t1_staff}}</td>
                        <td>{{$blood->band_t1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($blood->band_t2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->band_t2_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->band_t2_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->band_t2_time))}} น.
                           @endif</td>
                        <td>{{$blood->band_t2_staff}}</td>
                        <td>{{$blood->band_t2_remark}}</td>
                    </tr>
                    <!-- end of band-->
                    <!-- row of Analyzed -->
                    <tr>
                        <td rowspan="2"> Analyzed</td>
                        <td>Flask1</td>
                        <td>@if (is_null($blood->analyz_1_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->analyz_1_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->analyz_1_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->analyz_1_time))}} น.
                           @endif</td>
                        <td>{{$blood->analyz_1_staff}}</td>
                        <td>{{$blood->analyz_1_remark}}</td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>@if (is_null($blood->analyz_2_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->analyz_2_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->analyz_2_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->analyz_2_time))}} น.
                           @endif</td>
                        <td>{{$blood->analyz_2_staff}}</td>
                        <td>{{$blood->analyz_2_remark}}</td>
                    </tr>
                    <!-- end of Analyzed-->
                    <!-- row of Cytogennetic -->
                    <tr>
                        <td colspan="2"> Cytogennetic Notification</td>
                        <td>@if (is_null($blood->cyto_noti_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->cyto_noti_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->cyto_noti_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->cyto_noti_time))}} น.
                           @endif</td>
                        <td>{{$blood->cyto_noti_staff}}</td>
                        <td>{{$blood->cyto_noti_remark}}</td>
                    </tr>
                    <!-- end of Cytogennetic-->
                    <!-- row of report -->
                    <tr>
                        <td colspan="2"> reported</td>
                        <td>@if (is_null($blood->report_date))
                           
                           @else
                           {{date('d-m-Y', strtotime($blood->report_date))}} 
                           @endif</td>
                        <td>@if (is_null($blood->report_time))
                           
                           @else
                           {{date('H:i', strtotime($blood->report_time))}} น.
                           @endif</td>
                        <td>{{$blood->report_staff}}</td>
                        <td>{{$blood->report_remark}}</td>
                    </tr>
                    <!-- end of report-->
                </tbody>
            </table>
            <div class="row">
                <div class="col-11">
                    <p>Karyotype Result&nbsp;&nbsp;&nbsp;&nbsp; <b> {{$blood->karyo_result}}</b></p>
                    <p>Verified & Print By &nbsp;&nbsp;&nbsp;&nbsp;<b>{{$blood->virified_staff}} </b>&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($blood->virified_date))
                           
                           @else
                           <b>{{date('d-m-Y', strtotime($blood->virified_date))}}</b> 
                           @endif</p>
                    <p>E-mail sent By &nbsp;&nbsp;&nbsp;&nbsp;<b>{{$blood->email_staff}} </b>&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($blood->email_date))
                           
                           @else
                           <b>{{date('d-m-Y', strtotime($blood->email_date))}} </b>
                           @endif</p>
                    <p>หมายเหตุ&nbsp;&nbsp;&nbsp;&nbsp; <b>{{$blood->all_remark}}</b></p>
                </div>
                <div class="col-1">
                    <a href="{{ route('bloods.show',$blood->id)}}" target="_blank" class="btn  btn-light"><i class="fas fa-print"></i> Print</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-->
    <div class="modal fade" id="editModal{{ $blood->id }}" tabindex="-1" role="dialog"
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
                            <p> ชื่อ - สกุล : <b>{{$blood->pt_name}}</b><br>
                                หน่วยงาน :<b> {{$blood->pt_add}}</b></p>
                            <form method="post" action="{{ route('bloods.update', $blood->id) }}">
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
                                                    value="{{ $blood->cult_date }}" name="cult_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $blood->cult_time }}" name="cult_time" /></td>
                                            <td>
                                                <select class="form-control form-control-sm" name="cult_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->cult_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->cult_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->cult_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="cult_remark" value="{{ $blood->cult_remark }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> <b>Media exchanged</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="{{ $blood->media_date }}" name="media_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $blood->media_time }}" name="media_time" /></td>
                                            <td><select class="form-control form-control-sm" name="media_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->media_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->media_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->media_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="media_remark"  value="{{ $blood->media_remark }}"/></td>
                                        </tr>
                                        <!-- row of subculture -->
                                        <tr>
                                            <td rowspan="2"><b> Subcuture</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->subcul1_date }}"    name="subcul1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->subcul1_time }}"   name="subcul1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="subcul1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->subcul1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->subcul1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->subcul1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="subcul1_remark"  value="{{ $blood->subcul1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->subcul2_date }}"    name="subcul2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->subcul2_time }}"    name="subcul2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="subcul2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->subcul2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->subcul2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->subcul2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="subcul2_remark" value="{{ $blood->subcul2_remark }}"/></td>
                                        </tr>
                                        <!-- end of subculture-->
                                        <!-- row of Harvested -->
                                        <tr>
                                            <td rowspan="2"><b> Harvested</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->hvest_t1_date }}"    name="hvest_t1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->hvest_t1_time }}"    name="hvest_t1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="hvest_t1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->hvest_t1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->hvest_t1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->hvest_t1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="hvest_t1_remark" value="{{ $blood->hvest_t1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->hvest_t2_date }}"    name="hvest_t2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->hvest_t2_time }}"    name="hvest_t2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="hvest_t2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->hvest_t2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->hvest_t2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->hvest_t2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="hvest_t2_remark" value="{{ $blood->hvest_t2_remark }}"/></td>
                                        </tr>
                                        <!-- end of Harvested-->
                                        <!-- row of Slide -->
                                        <tr>
                                            <td rowspan="2"><b> Slide Prepared</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->slide_t1_date }}"     name="slide_t1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->slide_t1_time }}"     name="slide_t1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="slide_t1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->slide_t1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->slide_t1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->slide_t1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="slide_t1_remark" value="{{ $blood->slide_t1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->slide_t2_date }}"     name="slide_t2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->slide_t2_time }}"    name="slide_t2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="slide_t2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->slide_t2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์"  @if($blood->slide_t2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา"  @if($blood->slide_t2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="slide_t2_remark" value="{{ $blood->slide_t2_remark }}" /></td>
                                        </tr>
                                        <!-- end of Slide-->
                                        <!-- row of band -->
                                        <tr>
                                            <td rowspan="2"><b> Banding</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->band_t1_date }}"    name="band_t1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->band_t1_time }}"    name="band_t1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="band_t1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->band_t1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์"  @if($blood->band_t1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา"  @if($blood->band_t1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="band_t1_remark" value="{{ $blood->band_t1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->band_t2_date }}"    name="band_t2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->band_t2_time }}"     name="band_t2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="band_t2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->band_t2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->band_t2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->band_t2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="band_t2_remark" value="{{ $blood->band_t2_remark }}"/></td>
                                        </tr>
                                        <!-- end of band-->
                                        <!-- row of Analyzed -->
                                        <tr>
                                            <td rowspan="2"><b> Analyzed</b></td>
                                            <td><b>Flask1</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->analyz_1_date }}"    name="analyz_1_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->analyz_1_time }}"    name="analyz_1_time" /></td>
                                            <td><select class="form-control form-control-sm" name="analyz_1_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->analyz_1_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->analyz_1_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->analyz_1_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="analyz_1_remark" value="{{ $blood->analyz_1_remark }}"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->analyz_2_date }}"    name="analyz_2_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->analyz_2_time }}"    name="analyz_2_time" /></td>
                                            <td><select class="form-control form-control-sm" name="analyz_2_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->analyz_2_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->analyz_2_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->analyz_2_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="analyz_2_remark" value="{{ $blood->analyz_2_remark }}"/></td>
                                        </tr>
                                        <!-- end of Analyzed-->
                                        <!-- row of Cytogennetic -->
                                        <tr>
                                            <td colspan="2"><b> Cytogennetic Notification</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->cyto_noti_date }}"    name="cyto_noti_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->cyto_noti_time }}"     name="cyto_noti_time" /></td>
                                            <td><select class="form-control form-control-sm" name="cyto_noti_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($blood->cyto_noti_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->cyto_noti_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->cyto_noti_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="cyto_noti_remark" value="{{ $blood->cyto_noti_remark }}"/></td>
                                        </tr>
                                        <!-- end of Cytogennetic-->
                                        <!-- row of report -->
                                        <tr>
                                            <td colspan="2"><b> reported</b></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                            value="{{ $blood->report_date }}"     name="report_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                            value="{{ $blood->report_time }}"    name="report_time" /></td>
                                            <td><select class="form-control form-control-sm" name="report_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์"@if($blood->report_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($blood->report_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($blood->report_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="report_remark" value="{{ $blood->report_remark }}"/></td>
                                        </tr>
                                        <!-- end of report-->
                                    </tbody>
                                </table>
                                <div class="row mb-3">
                                    <div class="col-md-3 align-middle">
                                        <label>Karyotype Result</label>
                                        <input type="text" class="form-control form-control-sm" name="karyo_result"
                                            placeholder="ผล Karyotype" value="{{ $blood->karyo_result }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>Verified & Printed </label>
                                        <select class="form-control form-control-sm " name="virified_staff">
                                            <option value="">ผู้ออกผล</option>
                                            <option value="อมรรัตน์" @if($blood->virified_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                            <option value="ชัชวิชญ์" @if($blood->virified_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                            <option value="ฉัตรลดา" @if($blood->virified_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                        </select>
                                        <div class="mt-2">วันที่ออกผล </div>
                                        <input type="date" class="form-control form-control-sm" name="virified_date" value="{{ $blood->virified_date }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>E-mail sent </label>
                                        <select class="form-control form-control-sm " name="email_staff">
                                            <option value="">ผู้ส่ง</option>
                                            <option value="อมรรัตน์" @if($blood->email_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                            <option value="ชัชวิชญ์"  @if($blood->email_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                            <option value="ฉัตรลดา"  @if($blood->email_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                        </select>
                                        <div class="mt-2">วันที่ส่ง </div>
                                        <input type="date" class="form-control form-control-sm" name="email_date" value="{{ $blood->email_date }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>หมายเหตุ </label>
                                        <input type="text" class="form-control form-control-sm mb-3" name="all_remark"
                                            placeholder="หมายเหตุ" value="{{ $blood->all_remark }}" />
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