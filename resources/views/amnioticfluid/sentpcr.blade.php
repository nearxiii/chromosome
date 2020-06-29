@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')
<div class="container-xs">
    <div class="row">

        <div class="card mt-5" style="width: 100%">
            <div class="card-body text-center p-4">
                <h5 class="card-title">ส่งต่อ QF-PCR</h5>
                <div class="col-md-12 ">
                    <form method="post" action="{{ route('sentedpcr.store') }}">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6 ">
                                <div class="form-group text-left">
                                    <label class="mb-1"><b>วันที่รับสิ่งส่งตรวจ</b> </label>
                                    <input type="date" class="form-control" name="created_at"
                                        value="{{ $pcr_sents->created_at->toDateString()}}" /></div>
                            </div>
                            <div class="col-md-6 text-left">
                                <div class="form-group text-left">
                                    <label class="mb-1"><b>Lab Number</b> </label>
                                    <input type="text" class="form-control lab_no" name="lab_no" placeholder="Labnumber"
                                        value="{{$pcr_sents->lab_no}}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-left">
                            <label class="mb-1"><b>ชื่อ-สกุล</b> </label>
                            <input type="text" class="form-control lab_add" name="pt_name" placeholder="หน่วยงาน"
                                value="{{$pcr_sents->pt_name}}" />
                        </div>
                        <div class="form-group text-left">
                            <label class="mb-1"><b>หน่วยงาน</b> </label>
                            <input type="text" class="form-control lab_add" name="pt_add" placeholder="หน่วยงาน"
                                value="{{$pcr_sents->pt_add}}" />
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <label class="mb-1"><b>ปริมาณตะกอน</b> </label>
                                <input type="text" class="form-control lab_add" name="sample_quelity"
                                    placeholder="หน่วยงาน" value="{{$pcr_sents->sample_quelity}}" />
                            </div>
                            <div class="col-md-6 text-left">
                                <label class="mb-1"><b>การปนเปื้อนเลือด</b> </label>
                                <input type="text" class="form-control lab_add" name="sample_con" placeholder="หน่วยงาน"
                                    value="{{$pcr_sents->sample_con}}" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-success btn-block">ส่งต่อ</button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('amniotic.index')}}" class="btn btn-danger  btn-block">ยกเลิก</a>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection