@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container-xl">

    <div class="row">
        <div include="form-input-select()" class="col-sm-3 mb-4 mt-4">
            <form action="findtest" method="GET">
                <select required class="custom-select " name="search">
                    <option selected>เลือกรายการตรวจ</option>
                    <option value="Karyotyping">Karyotyping</option>
                    <option value="QF-PCR">QF-PCR</option>
                    <option value="Combo">Combo</option>
                </select>
        </div>
        <div class="col-md-1 mb-4 mt-4">
            <button type="submit" class="btn btn-outline-primary ">Filtter</button>
        </div>
        <div class="col-sm-4 text-center mt-4 mb-4">
            <h3 class="d-inline-block align-middle">รายการรับแลบโครโมโซม</h3>
        </div>
        <div class="col-sm-4 mb-4 mt-4">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal"><i
                    class="fas fa-plus"></i>
                ลงทะเบียนรับสิ่งส่งตรวจ
            </button>
        </div>
        </form>
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

    <table id="patTable" class="table table-hover table-sm  ">
        <thead>
            <tr>
                <th>วันที่รับตัวอย่าง</th>
                <th>ชื่อ-นามสกุล</th>
                <th>แพทย์</th>
                <th>หน่วยงาน</th>
                <th width="7%">สิ่งส่งตรวจ</th>
                <th>รายการตรวจ</th>
                <th>ผู้รับ</th>
                <th>โลจิสติกส์</th>
                <th>วันที่รายงาน</th>
                <th>วันที่ส่ง email</th>
                <th>LabNumber</th>
                <th width="10%">remark</th>
                <th colspan=2 width="3%">Actions</th>

            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
    
</div>

@endsection