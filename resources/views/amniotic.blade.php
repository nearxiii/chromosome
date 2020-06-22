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
    <div class="modal fade" id="addModal"  role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-success" style="margin: 0 auto; " id="addModalLabel">
                        ลงทะเบียนรับสิ่งส่งตรวจ</h3>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 offset-sm-1">


                            <form method="post" action="">
                                @csrf
                                <div class="form-group">
                                <label >วันที่รับสิ่งส่งตรวจ</label>
                                    <input type="date" class="form-control" name="created_at"
                                        value="<?php echo date("Y-m-d");?>" placeholder="วันที่" /></div>
                                <div class="form-group lab_name">
                                    
                                    <select class="form-control select_name" style="width: 100%" name="chromo_name" id="lab_name">
                                    <option value="">ค้น lab number</option>
                                    @foreach($namelist as $key )
                              <option value="{{$key->chromo_number}}" data-price="{{$key->chromo_name}}">{{$key->chromo_number}}</option>
                              @endforeach
                              </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control lab_no" name="chromo_doc" placeholder="ชื่อ-สกุล" required/>
                                </div>
                               
                               
                                

                                <div class="form-group">
                                    <!-- <label for="pat_address">ที่อยู่:</label> -->
                                    <textarea class="form-control" rows="2" name="chromo_remark"
                                        placeholder="remark"></textarea>
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

        </tbody>
    </table>
    
</div>
<script>
$('.lab_name').on('change', function() {
  $('.lab_no')
  .val(
    $(this).find(':selected').data('price')
  );
});

$(document).ready(function() {
    $('.select_name').select2();
});
</script>
@endsection