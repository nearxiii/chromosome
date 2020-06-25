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
                <div class="col-2"></div>
                <div class="col-1">
                    <div class="row">
                        <div class="col-sm"><a href="#" class="btn btn-sm btn-outline-toglle" data-toggle="modal"
                                data-target="#editModal{{ $amniotics->id }}"><i class="far fa-edit"></i></a></div>
                        <div class="col-sm"><a href="#" class="btn btn-sm btn-outline-toglle"><i
                                    class="fas fa-sign-out-alt"></i></a></div>
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
                        <td>121</td>
                        <td>1212</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"> Media exchanged</td>
                        <td>121</td>
                        <td>1212</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <!-- row of subculture -->
                    <tr>
                        <td rowspan="2"> Subcuture</td>
                        <td>Flask1</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <!-- end of subculture-->
                    <!-- row of Harvested -->
                    <tr>
                        <td rowspan="2"> Harvested</td>
                        <td>Flask1</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <!-- end of Harvested-->
                    <!-- row of Slide -->
                    <tr>
                        <td rowspan="2"> Slide Prepared</td>
                        <td>Flask1</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <!-- end of Slide-->
                    <!-- row of band -->
                    <tr>
                        <td rowspan="2"> Banding</td>
                        <td>Flask1</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <!-- end of band-->
                    <!-- row of Analyzed -->
                    <tr>
                        <td rowspan="2"> Analyzed</td>
                        <td>Flask1</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Flask2</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <!-- end of Analyzed-->
                    <!-- row of Cytogennetic -->
                    <tr>
                        <td colspan="2"> Cytogennetic Notification</td>
                        <td>121</td>
                        <td>1212</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <!-- end of Cytogennetic-->
                    <!-- row of report -->
                    <tr>
                        <td colspan="2"> reported</td>
                        <td>121</td>
                        <td>1212</td>
                        <td>121312</td>
                        <td></td>
                    </tr>
                    <!-- end of report-->
                </tbody>
            </table>
            <div class="row">
                <div class="col-12">
                    <p>Karyotype Result .........................................</p>
                    <p>Verified & Print By ............................ Date ..............................</p>
                    <p>E-mail sent By ............................ Date ..............................</p>
                    <p>หมายเหตุ ..............................</p>
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
                                            <th >วันที่ปฏิบัติงาน</th>
                                            <th>เวลาปฏิบัติงาน</th>
                                            <th width="20%">ผู้ปฏิบัติงาน</th>
                                            <th>หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td colspan="2"><b> Culture</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                     /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> <b>Media exchanged</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                     /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <!-- row of subculture -->
                                        <tr>
                                            <td rowspan="2"><b> Subcuture</b></td>
                                            <td><b>Flask1</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                    /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                    /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <!-- end of subculture-->
                                        <!-- row of Harvested -->
                                        <tr>
                                            <td rowspan="2"><b> Harvested</b></td>
                                            <td><b>Flask1</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                     /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                    /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <!-- end of Harvested-->
                                        <!-- row of Slide -->
                                        <tr>
                                            <td rowspan="2"><b> Slide Prepared</b></td>
                                            <td><b>Flask1</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                    /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                    /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <!-- end of Slide-->
                                        <!-- row of band -->
                                        <tr>
                                            <td rowspan="2"><b> Banding</b></td>
                                            <td><b>Flask1</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                    /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                    /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <!-- end of band-->
                                        <!-- row of Analyzed -->
                                        <tr>
                                            <td rowspan="2"><b> Analyzed</b></td>
                                            <td><b>Flask1</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                    /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Flask2</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                    /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <!-- end of Analyzed-->
                                        <!-- row of Cytogennetic -->
                                        <tr>
                                            <td colspan="2"><b> Cytogennetic Notification</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                 /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <!-- end of Cytogennetic-->
                                        <!-- row of report -->
                                        <tr>
                                            <td colspan="2"><b> reported</b></td>
                                            <td ><input type="date" class="form-control" name="created_at"
                                                   /></td>
                                            <td><input type="time" class="form-control" name="created_at" /></td>
                                            <td><select required class="custom-select " name="logis_staff">
                                                    <option value=""></option>
                                                    <option value="อมรรัตน์">อมรรัตน์</option>
                                                    <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                                    <option value="ฉัตรลดา">ฉัตรลดา</option>
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control lab_no" name="lab_no" /></td>
                                        </tr>
                                        <!-- end of report-->
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-3 align-middle">
                                       <label >Karyotype Result</label> 
                                       <input type="text" class="form-control lab_no" name="lab_no" placeholder="ผล Karyotype" />
                                    </div>
                                </div>
                                <div class="modal-footer text-center">
                                            <button type="submit"
                                                class="btn btn-success btn-lg  ">บันทึก</button><br />

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