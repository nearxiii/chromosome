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
                                        <option value="{{$key->chromo_name}}" data-price="{{$key->chromo_number}}" data-add="{{$key->chromo_hos}}">
                                            {{$key->chromo_name}} ( {{$key->chromo_number}} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control lab_no" name="lab_no"
                                        placeholder="Labnumber" required readonly />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control lab_add" name="pt_add"
                                        placeholder="หน่วยงาน" required readonly />
                                </div>
                                <label><b> ปริมาณตะกอน</b></label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline pr-5">
                                        <input class="form-check-input" type="checkbox" id="qulti1" value="น้อย" name="sample_quelity">
                                        <label class="form-check-label" for="qulti1">น้อย</label>
                                    </div>
                                    <div class="form-check form-check-inline pr-5">
                                        <input class="form-check-input" type="checkbox" id="qulti2" value="ปานกลาง" name="sample_quelity">
                                        <label class="form-check-label" for="qulti2">ปานกลาง</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="qulti3" value="มาก" name="sample_quelity">
                                        <label class="form-check-label" for="qulti3">มาก</label>
                                    </div>
                                </div>
                                <label><b> การปนเปื้อนเลือด</b></label>
                                <div class="form-group">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="con1" value="ไม่มี" name="sample_con[]">
                                        <label class="form-check-label" for="con1">ไม่มี</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="con2" value="มี" name="sample_con[]">
                                        <label class="form-check-label" for="con2">มี</label>
                                    </div>
                                    
                                    <label class="pr-3"><b> ปริมาณ</b></label>
                                    
                                    <div class="form-check form-check-inline pr-3">
                                        <input class="form-check-input" type="checkbox" id="conq1" value="น้อย" name="sample_con[]">
                                        <label class="form-check-label" for="conq1">น้อย</label>
                                    </div>
                                    <div class="form-check form-check-inline pr-3">
                                        <input class="form-check-input" type="checkbox" id="conq2" value="ปานกลาง" name="sample_con[]">
                                        <label class="form-check-label" for="conq2">ปานกลาง</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="conq3" value="มาก" name="sample_con[]">
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



    <table id="patTable" class="table table-hover table-sm  ">
        <thead>
            <tr>
                <th>วันที่รับตัวอย่าง</th>
                <th>LabNumber</th>
                <th>ชื่อ-นามสกุล</th>
                <th>รายการตรวจ</th>
                <th>หน่วยงาน</th>
                <th>สถานะ</th>
                <th colspan=2 width="3%">Actions</th>

            </tr>
        </thead>
        <tbody>
        @foreach($amniotic as $amniotics)
            <tr>
              
                <td >{{$amniotics->created_at->format('d/m/Y')}}</td>
                <td >{{$amniotics->lab_no}}</td>
                <td >{{$amniotics->pt_name}}</td>
                <td >{{$amniotics->pt_add}}</td>
                <td ></td>
                <td ></td>
            </tr>
            <tr>
            <td><p>ปริมาณตะกอน&nbsp; <b>{{$amniotics->sample_quelity}}</b> , การปนเปื้อนเลือด&nbsp;<b> {{$amniotics->sample_con}}</b></p></td>
            </tr>
            <tr>
            
            <th>วันที่รับตัวอย่าง</th>
                <th>รายการ</th>
                <th>วันที่ปฏิบัติงาน</th>
                <th>เวลาปฏิบัติงาน</th>
                <th>ผู้ปฏิบัติงาน</th>
                <th>หมายเหตุ</th>
            </tr>

            @endforeach
        </tbody>
    </table>

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
});
</script>
@endsection