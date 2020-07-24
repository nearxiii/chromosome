@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container">

    <div class="row">

        <div class="col-sm-4  mt-4 mb-4">
            <h3 class="d-inline-block align-middle">บันทึกรายการ QF-PCR</h3>
        </div>
        <div class=" col-sm-5 mb-4 mt-4">

            <form action="findtest" class="form-inline" method="GET">

                <input type="text" class="form-control " style="width: 70%;" name="search_name"
                    placeholder="ค้นชื่อ-สกุล" />


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


                            <form method="post" action="{{ route('pcr.store') }}">
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
                                <div include="form-input-select()">
                                    <select required class="custom-select mb-3" name="sample_type" id="sample_type">
                                        <option value="">ชนิดสิ่งส่งตรวจ</option>
                                        <option value="น้ำคร่ำ">น้ำคร่ำ</option>
                                        <option value="เลือด">เลือด</option>
                                    </select>
                                </div>
                                <div class="row" id="amniotic_type">
                                    <div class="col">
                                        <label><b> ปริมาณตะกอน</b></label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline pr-5">
                                                <input class="form-check-input" type="checkbox" id="qulti1" value="น้อย"
                                                    name="sample_quelity">
                                                <label class="form-check-label" for="qulti1">น้อย</label>
                                            </div>
                                            <div class="form-check form-check-inline pr-5">
                                                <input class="form-check-input" type="checkbox" id="qulti2"
                                                    value="ปานกลาง" name="sample_quelity">
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
                                                <input class="form-check-input" type="checkbox" id="conq2"
                                                    value="ปานกลาง" name="sample_con[]">
                                                <label class="form-check-label" for="conq2">ปานกลาง</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="conq3" value="มาก"
                                                    name="sample_con[]">
                                                <label class="form-check-label" for="conq3">มาก</label>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row" id="blood_type">
                                        <div class="col">
                                            <label><b> ลักษณะ</b></label>
                                            <div class="form-group">
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="checkbox" id="qulti1"
                                                        value="Normal" name="sample_clot">
                                                    <label class="form-check-label" for="qulti1">Normal</label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="checkbox" id="qulti2"
                                                        value="Complete hemolysis" name="sample_clot">
                                                    <label class="form-check-label" for="qulti2">Complete
                                                        hemolysis</label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="checkbox" id="qulti3"
                                                        value="Partial hemolysis" name="sample_clot">
                                                    <label class="form-check-label" for="qulti3">Partial
                                                        hemolysis</label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="checkbox" id="qulti4"
                                                        value="Complete clot" name="sample_clot">
                                                    <label class="form-check-label" for="qulti4">Complete clot</label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="checkbox" id="qulti5"
                                                        value="Partial clot" name="sample_clot">
                                                    <label class="form-check-label" for="qulti5">Partial clot</label>
                                                </div>
                                            </div>
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
    @foreach($pcrs as $pcr)
    <div class="card mb-2 shadow-sm">

        <div class="card-body">
            <div class="row">
                <div class="col-sm-1 "><button class="btn btn-sm btn-outline-toglle togle_subtable" id="{{$pcr->id}}"><i
                            class="fas fa-angle-down"></i></button></div>
                <div class="col-2">{{$pcr->created_at->format('d/m/Y')}}</div>
                <div class="col-2">{{$pcr->lab_no}}</div>
                <div class="col-2">{{$pcr->pt_name}}</div>
                <div class="col-2">{{$pcr->pt_add}}</div>
                <div class="col-2">
                    @if (is_null($pcr->email_date))
                    @if (is_null($pcr->analyz_date))
                    @if (is_null($pcr->frag_date))
                    @if (is_null($pcr->pcr_date))
                    @if (is_null($pcr->dna_date))
                    <span class="badge badge-pill badge-danger">รอตรวจ</span>
                    @else
                    <span class="badge badge-pill badge-primary">DNA Extraction</span>
                    @endif
                    @else
                    <span class="badge badge-pill badge-primary">PCR</span>
                    @endif
                    @else
                    <span class="badge badge-pill badge-primary">Fragment analysis</span>
                    @endif
                    @else
                    <span class="badge badge-pill badge-success">Analyzed</span>

                    @endif
                    @else
                    <span class="badge badge-pill badge-warning">ส่งผลแล้ว </span>
                    @endif
                </div>
                <div class="col-1">
                    <div class="row">
                        <div class="col-sm"><a href="#" class="btn btn-sm btn-outline-toglle" data-toggle="modal"
                                data-target="#editModal{{ $pcr->id }}"><i class="far fa-edit"></i></a></div>

                        <div class="col-sm"><a href="#" class="btn btn-sm btn-outline-toglle-del" data-toggle="modal"
                                data-target="#"><i class="far fa-trash-alt"></i></a></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-body mx-3 sub_table{{$pcr->id}} hid_sub">
            @if (is_null($pcr->sample_clot))
            <p>ปริมาณตะกอน&nbsp; <b>{{$pcr->sample_quelity}}</b> , การปนเปื้อนเลือด&nbsp;<b>
                    {{$pcr->sample_con}}</b></p>
            @else
            <p>ลักษณะ&nbsp; <b>{{$pcr->sample_clot}}</b></p>
            @endif

            <table id="patTable" class="table table-bordered table-sm  ">
                <thead>
                    <tr>
                        <th>รายการ</th>
                        <th>ความเข้มข้น DNA</th>
                        <th>วันที่ปฏิบัติงาน</th>
                        <th>เวลาปฏิบัติงาน</th>
                        <th>ผู้ปฏิบัติงาน</th>
                        <th>หมายเหตุ</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td> DNA Extraction</td>
                        <td> {{$pcr->dna_conc}}</td>
                        <td>@if (is_null($pcr->dna_date))

                            @else
                            {{date('d-m-Y', strtotime($pcr->dna_date))}}
                            @endif
                        </td>
                        <td>@if (is_null($pcr->dna_time))

                            @else
                            {{date('H:i', strtotime($pcr->dna_time))}} น.
                            @endif</td>
                        <td>{{$pcr->dna_staff}}</td>
                        <td>{{$pcr->dna_remark}}</td>
                    </tr>
                    <tr>
                        <td> PCR</td>
                        <td> {{$pcr->pcr_conc}}</td>
                        <td>@if (is_null($pcr->pcr_date))

                            @else
                            {{date('d-m-Y', strtotime($pcr->pcr_date))}}
                            @endif</td>
                        <td>@if (is_null($pcr->pcr_time))

                            @else
                            {{date('H:i', strtotime($pcr->pcr_time))}} น.
                            @endif</td>
                        <td>{{$pcr->pcr_staff}}</td>
                        <td>{{$pcr->pcr_remark}}</td>
                    </tr>
                    <tr>
                        <td> Fragment analysis</td>
                        <td>{{$pcr->frag_conc}}</td>
                        <td>@if (is_null($pcr->frag_date))

                            @else
                            {{date('d-m-Y', strtotime($pcr->frag_date))}}
                            @endif</td>
                        <td>@if (is_null($pcr->frag_time))

                            @else
                            {{date('H:i', strtotime($pcr->frag_time))}} น.
                            @endif</td>
                        <td>{{$pcr->frag_staff}}</td>
                        <td>{{$pcr->frag_remark}}</td>
                    </tr>
                    <tr>
                        <td>Dilution factor</td>
                        <td colspan="5">{{$pcr->dilute_fac}}</td>
                    </tr>

                </tbody>
            </table>
            <div class="row">
                <div class="col-11">
                    <p>PCR Result&nbsp;&nbsp;&nbsp;&nbsp; <b> {{$pcr->pcr_result}}</b></p>
                    <p>Analyzed by &nbsp;&nbsp;&nbsp;&nbsp; <b> {{$pcr->analyz_staff}}</b>
                        &nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($pcr->analyz_date))

                        @else
                        <b>{{date('d-m-Y', strtotime($pcr->analyz_date))}}</b>
                        @endif</p>
                    <p>Verified & Print By &nbsp;&nbsp;&nbsp;&nbsp;<b>{{$pcr->virified_staff}}
                        </b>&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($pcr->virified_date))

                        @else
                        <b>{{date('d-m-Y', strtotime($pcr->virified_date))}}</b>
                        @endif</p>
                    <p>E-mail sent By &nbsp;&nbsp;&nbsp;&nbsp;<b>{{$pcr->email_staff}}
                        </b>&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($pcr->email_date))

                        @else
                        <b>{{date('d-m-Y', strtotime($pcr->email_date))}} </b>
                        @endif</p>
                    <p>หมายเหตุ&nbsp;&nbsp;&nbsp;&nbsp; <b>{{$pcr->remark}}</b></p>
                </div>
                <div class="col-1">
                    <a href="" class="btn  btn-light"><i class="fas fa-print"></i> Print</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-->
    <div class="modal fade" id="editModal{{ $pcr->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-success" style="margin: 0 auto; " id="addModalLabel">
                        อัพเดทสถานะ QF-PCR</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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
                            <p> ชื่อ - สกุล : <b>{{$pcr->pt_name}}</b><br>
                                หน่วยงาน :<b> {{$pcr->pt_add}}</b></p>
                            <form method="post" action="{{ route('pcr.update', $pcr->id) }}">
                                @method('PATCH')
                                @csrf
                                <table id="patTable" class="table table-bordered table-sm  ">
                                    <thead>
                                        <tr>
                                            <th>รายการ</th>
                                            <th>ความเข้มข้น DNA</th>
                                            <th>วันที่ปฏิบัติงาน</th>
                                            <th>เวลาปฏิบัติงาน</th>
                                            <th width="20%">ผู้ปฏิบัติงาน</th>
                                            <th>หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b> DNA Extraction</b></td>
                                            <td><input type="text" class="form-control form-control-sm" name="dna_conc"
                                                    value="{{ $pcr->dna_conc }}" /></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="{{ $pcr->dna_date }}" name="dna_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $pcr->dna_time }}" name="dna_time" /></td>
                                            <td>
                                                <select class="form-control form-control-sm" name="dna_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($pcr->dna_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($pcr->dna_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($pcr->dna_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="dna_remark" value="{{ $pcr->dna_remark }}" /></td>
                                        </tr>
                                        <tr>
                                            <td> <b>PCR</b></td>
                                            <td><input type="text" class="form-control form-control-sm" name="pcr_conc"
                                                    value="{{ $pcr->pcr_conc }}" /></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="{{ $pcr->pcr_date }}" name="pcr_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $pcr->pcr_time }}" name="pcr_time" /></td>
                                            <td><select class="form-control form-control-sm" name="pcr_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($pcr->pcr_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($pcr->pcr_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($pcr->pcr_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="pcr_remark" value="{{ $pcr->pcr_remark }}" /></td>
                                        </tr>
                                        <!-- row of subculture -->
                                        <tr>
                                            <td><b> Fragment analysis</b></td>
                                            <td><input type="text" class="form-control form-control-sm" name="frag_conc"
                                                    value="{{ $pcr->frag_conc }}" /></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="{{ $pcr->frag_date }}" name="frag_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $pcr->frag_time }}" name="frag_time" /></td>
                                            <td><select class="form-control form-control-sm" name="frag_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($pcr->frag_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($pcr->frag_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($pcr->frag_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="frag_remark" value="{{ $pcr->frag_remark }}" /></td>
                                        </tr>
                                        <tr>
                                            <td><b> Dilution factor</b></td>
                                            <td colspan="5">
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline pr-5">
                                                        <input class="form-check-input" type="checkbox" id="qulti1"
                                                            value="No dilution" name="dilute_fac">
                                                        <label class="form-check-label" for="qulti1">No dilution</label>
                                                    </div>
                                                    <div class="form-check form-check-inline pr-5">
                                                        <input class="form-check-input" type="checkbox" id="qulti2"
                                                            value="1:10 ul" name="dilute_fac">
                                                        <label class="form-check-label" for="qulti2">1:10 ul</label>
                                                    </div>
                                                    <div class="form-check form-check-inline pr-5">
                                                        <input class="form-check-input" type="checkbox" id="qulti3"
                                                            value="1:30 ul" name="dilute_fac">
                                                        <label class="form-check-label" for="qulti3">1:30 ul</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="qulti4"
                                                            value="1:50 ul" name="dilute_fac">
                                                        <label class="form-check-label" for="qulti4">1:50 ul</label>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="dilute_fac" placeholder="อื่นๆ ระบุ" />
                                            </td>

                                        </tr>
                                        <!-- end of subculture-->

                                    </tbody>
                                </table>
                                <div class="row mb-3">
                                    <div class="col-md-3 align-middle">
                                        <label>PCR Result</label>
                                        <input type="text" class="form-control form-control-sm" name="pcr_result"
                                            placeholder="ผล QF-PCR" value="{{ $pcr->pcr_result }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>Verified & Printed </label>
                                        <select class="form-control form-control-sm " name="virified_staff">
                                            <option value="">ผู้ออกผล</option>
                                            <option value="อมรรัตน์" @if($pcr->virified_staff=="อมรรัตน์")
                                                selected='selected' @endif>อมรรัตน์</option>
                                            <option value="ชัชวิชญ์" @if($pcr->virified_staff=="ชัชวิชญ์")
                                                selected='selected' @endif>ชัชวิชญ์</option>
                                            <option value="ฉัตรลดา" @if($pcr->virified_staff=="ฉัตรลดา")
                                                selected='selected' @endif>ฉัตรลดา</option>
                                        </select>
                                        <div class="mt-2">วันที่ออกผล </div>
                                        <input type="date" class="form-control form-control-sm" name="virified_date"
                                            value="{{ $pcr->virified_date }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>E-mail sent </label>
                                        <select class="form-control form-control-sm " name="email_staff">
                                            <option value="">ผู้ส่ง</option>
                                            <option value="อมรรัตน์" @if($pcr->email_staff=="อมรรัตน์")
                                                selected='selected' @endif>อมรรัตน์</option>
                                            <option value="ชัชวิชญ์" @if($pcr->email_staff=="ชัชวิชญ์")
                                                selected='selected' @endif>ชัชวิชญ์</option>
                                            <option value="ฉัตรลดา" @if($pcr->email_staff=="ฉัตรลดา")
                                                selected='selected' @endif>ฉัตรลดา</option>
                                        </select>
                                        <div class="mt-2">วันที่ส่ง </div>
                                        <input type="date" class="form-control form-control-sm" name="email_date"
                                            value="{{ $pcr->email_date }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>หมายเหตุ </label>
                                        <input type="text" class="form-control form-control-sm mb-3" name="remark"
                                            placeholder="หมายเหตุ" value="{{ $pcr->remark }}" />
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
    $("#sample_type").change(function()
        {
            if($(this).val() == "น้ำคร่ำ")
        {
            $("#amniotic_type").show();
        }
        else
        {
            $("#amniotic_type").hide();
        }
    });
    $("#sample_type").change(function()
        {
            if($(this).val() == "เลือด")
        {
            $("#blood_type").show();
        }
        else
        {
            $("#blood_type").hide();
        }
    });
        $("#amniotic_type").hide();
        $("#blood_type").hide();
});


</script>
@endsection