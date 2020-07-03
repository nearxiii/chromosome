@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container">

    <div class="row">

        <div class="col-sm-4  mt-4 mb-4">
            <h3 class="d-inline-block align-middle">บันทึกรายการส่งต่อ QF-PCR</h3>
        </div>
        <div class=" col-sm-5 mb-4 mt-4">

            <form action="findtest" class="form-inline" method="GET">

                <input type="text" class="form-control " style="width: 70%;" name="search_name"
                    placeholder="ค้นชื่อ-สกุล" />


                <button type="submit" class="btn btn-outline-primary ml-3">ค้นหา</button>

            </form>
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



    <div class="row mb-3 ">
        <div class="col-sm-1 "></div>
        <div class="col-2"><b> วันที่รับตัวอย่าง</b></div>
        <div class="col-2"><b> LabNumber</b></div>
        <div class="col-2"><b> ชื่อ-นามสกุล</b></div>
        <div class="col-2"><b> หน่วยงาน</b></div>
        <div class="col-2"><b> สถานะ</b></div>
        <div class="col-1"><b> Actions</b></div>
    </div>
    @foreach($senteds as $sented)
    <div class="card mb-2 shadow-sm">

        <div class="card-body">
            <div class="row">
                <div class="col-sm-1 "><button class="btn btn-sm btn-outline-toglle togle_subtable"
                        id="{{$sented->id}}"><i class="fas fa-angle-down"></i></button></div>
                <div class="col-2">{{$sented->created_at->format('d/m/Y')}}</div>
                <div class="col-2">{{$sented->lab_no}}</div>
                <div class="col-2">{{$sented->pt_name}}</div>
                <div class="col-2">{{$sented->pt_add}}</div>
                <div class="col-2">
                    @if (is_null($sented->email_date))
                        @if (is_null($sented->analyz_date))
                            @if (is_null($sented->frag_date))
                                @if (is_null($sented->pcr_date))
                                    @if (is_null($sented->dna_date))
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
                                data-target="#editModal{{ $sented->id }}"><i class="far fa-edit"></i></a></div>

                        <div class="col-sm"><a href="#" class="btn btn-sm btn-outline-toglle-del" data-toggle="modal"
                                data-target="#"><i class="far fa-trash-alt"></i></a></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-body mx-3 sub_table{{$sented->id}} hid_sub">
            <p>ปริมาณตะกอน&nbsp; <b>{{$sented->sample_quelity}}</b> , การปนเปื้อนเลือด&nbsp;<b>
                    {{$sented->sample_con}}</b></p>
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
                        <td> {{$sented->dna_conc}}</td>
                        <td>@if (is_null($sented->dna_date))

                            @else
                            {{date('d-m-Y', strtotime($sented->dna_date))}}
                            @endif
                        </td>
                        <td>@if (is_null($sented->dna_time))

                            @else
                            {{date('H:i', strtotime($sented->dna_time))}} น.
                            @endif</td>
                        <td>{{$sented->dna_staff}}</td>
                        <td>{{$sented->dna_remark}}</td>
                    </tr>
                    <tr>
                        <td> PCR</td>
                        <td> {{$sented->pcr_conc}}</td>
                        <td>@if (is_null($sented->pcr_date))

                            @else
                            {{date('d-m-Y', strtotime($sented->pcr_date))}}
                            @endif</td>
                        <td>@if (is_null($sented->pcr_time))

                            @else
                            {{date('H:i', strtotime($sented->pcr_time))}} น.
                            @endif</td>
                        <td>{{$sented->pcr_staff}}</td>
                        <td>{{$sented->pcr_remark}}</td>
                    </tr>
                    <tr>
                        <td> Fragment analysis</td>
                        <td>{{$sented->frag_conc}}</td>
                        <td>@if (is_null($sented->frag_date))

                            @else
                            {{date('d-m-Y', strtotime($sented->frag_date))}}
                            @endif</td>
                        <td>@if (is_null($sented->frag_time))

                            @else
                            {{date('H:i', strtotime($sented->frag_time))}} น.
                            @endif</td>
                        <td>{{$sented->frag_staff}}</td>
                        <td>{{$sented->frag_remark}}</td>
                    </tr>
                    <tr>
                        <td>Dilution factor</td>
                        <td colspan="5">{{$sented->dilute_fac}}</td>
                    </tr>

                </tbody>
            </table>
            <div class="row">
                <div class="col-11">
                    <p>PCR Result&nbsp;&nbsp;&nbsp;&nbsp; <b> {{$sented->pcr_result}}</b></p>
                    <p>Analyzed by &nbsp;&nbsp;&nbsp;&nbsp; <b> {{$sented->analyz_staff}}</b>
                        &nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($sented->analyz_date))

                        @else
                        <b>{{date('d-m-Y', strtotime($sented->analyz_date))}}</b>
                        @endif</p>
                    <p>Verified & Print By &nbsp;&nbsp;&nbsp;&nbsp;<b>{{$sented->virified_staff}}
                        </b>&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($sented->virified_date))

                        @else
                        <b>{{date('d-m-Y', strtotime($sented->virified_date))}}</b>
                        @endif</p>
                    <p>E-mail sent By &nbsp;&nbsp;&nbsp;&nbsp;<b>{{$sented->email_staff}}
                        </b>&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;
                        @if (is_null($sented->email_date))

                        @else
                        <b>{{date('d-m-Y', strtotime($sented->email_date))}} </b>
                        @endif</p>
                    <p>หมายเหตุ&nbsp;&nbsp;&nbsp;&nbsp; <b>{{$sented->remark}}</b></p>
                </div>
                <div class="col-1">
                    <a href="" class="btn  btn-light"><i class="fas fa-print"></i> Print</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-->
    <div class="modal fade" id="editModal{{ $sented->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-success" style="margin: 0 auto; " id="addModalLabel">
                        อัพเดทสถานะ QF-PCR</h3>
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
                            <p> ชื่อ - สกุล : <b>{{$sented->pt_name}}</b><br>
                                หน่วยงาน :<b> {{$sented->pt_add}}</b></p>
                            <form method="post" action="{{ route('sentedpcr.update', $sented->id) }}">
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
                                                    value="{{ $sented->dna_conc }}" /></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="{{ $sented->dna_date }}" name="dna_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $sented->dna_time }}" name="dna_time" /></td>
                                            <td>
                                                <select class="form-control form-control-sm" name="dna_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($sented->dna_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($sented->dna_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($sented->dna_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="dna_remark" value="{{ $sented->dna_remark }}" /></td>
                                        </tr>
                                        <tr>
                                            <td> <b>PCR</b></td>
                                            <td><input type="text" class="form-control form-control-sm" name="pcr_conc"
                                                    value="{{ $sented->pcr_conc }}" /></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="{{ $sented->pcr_date }}" name="pcr_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $sented->pcr_time }}" name="pcr_time" /></td>
                                            <td><select class="form-control form-control-sm" name="pcr_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($sented->pcr_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($sented->pcr_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($sented->pcr_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="pcr_remark" value="{{ $sented->pcr_remark }}" /></td>
                                        </tr>
                                        <!-- row of subculture -->
                                        <tr>
                                            <td><b> Fragment analysis</b></td>
                                            <td><input type="text" class="form-control form-control-sm"
                                                    name="frag_conc" value="{{ $sented->frag_conc }}" /></td>
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="{{ $sented->frag_date }}" name="frag_date" /></td>
                                            <td><input type="time" class="form-control form-control-sm"
                                                    value="{{ $sented->frag_time }}" name="frag_time" /></td>
                                            <td><select class="form-control form-control-sm" name="frag_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์" @if($sented->frag_staff=="อมรรัตน์")
                                                        selected='selected' @endif>อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์" @if($sented->frag_staff=="ชัชวิชญ์")
                                                        selected='selected' @endif>ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา" @if($sented->frag_staff=="ฉัตรลดา")
                                                        selected='selected' @endif>ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control form-control-sm"
                                                    name="frag_remark" value="{{ $sented->frag_remark }}" /></td>
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
                                            placeholder="ผล QF-PCR" value="{{ $sented->pcr_result }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>Verified & Printed </label>
                                        <select class="form-control form-control-sm " name="virified_staff">
                                            <option value="">ผู้ออกผล</option>
                                            <option value="อมรรัตน์" @if($sented->virified_staff=="อมรรัตน์")
                                                selected='selected' @endif>อมรรัตน์</option>
                                            <option value="ชัชวิชญ์" @if($sented->virified_staff=="ชัชวิชญ์")
                                                selected='selected' @endif>ชัชวิชญ์</option>
                                            <option value="ฉัตรลดา" @if($sented->virified_staff=="ฉัตรลดา")
                                                selected='selected' @endif>ฉัตรลดา</option>
                                        </select>
                                        <div class="mt-2">วันที่ออกผล </div>
                                        <input type="date" class="form-control form-control-sm" name="virified_date"
                                            value="{{ $sented->virified_date }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>E-mail sent </label>
                                        <select class="form-control form-control-sm " name="email_staff">
                                            <option value="">ผู้ส่ง</option>
                                            <option value="อมรรัตน์" @if($sented->email_staff=="อมรรัตน์")
                                                selected='selected' @endif>อมรรัตน์</option>
                                            <option value="ชัชวิชญ์" @if($sented->email_staff=="ชัชวิชญ์")
                                                selected='selected' @endif>ชัชวิชญ์</option>
                                            <option value="ฉัตรลดา" @if($sented->email_staff=="ฉัตรลดา")
                                                selected='selected' @endif>ฉัตรลดา</option>
                                        </select>
                                        <div class="mt-2">วันที่ส่ง </div>
                                        <input type="date" class="form-control form-control-sm" name="email_date"
                                            value="{{ $sented->email_date }}" />
                                    </div>
                                    <div class="col-md-3 align-middle">
                                        <label>หมายเหตุ </label>
                                        <input type="text" class="form-control form-control-sm mb-3" name="remark"
                                            placeholder="หมายเหตุ" value="{{ $sented->remark }}" />
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
$(document).ready(function() {

    $('.hid_sub').hide();
    $('.togle_subtable').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        $('.sub_table' + id).toggle();
    });

});
</script>
@endsection