@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container">
    <div class="row mt-4 justify-content-center d-flex">
        <div class="col-7">
            <ul class="nav nav-pills " role="tablist">
                <li class="nav-item ">
                    <a class="nav-link btn btn-outline-secondary mr-4" data-toggle="pill" href="#home"><b> Karyotype น้ำคร่ำ
                        </b><span class='badge  badge-danger'></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-secondary mr-4" data-toggle="pill" href="#menu1"><B>Karyotype เลือด
                        </B><span class='badge  badge-danger'></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-secondary mr-4" data-toggle="pill" href="#menu2"><b> QF-PCR </b>
                        <span class='badge  badge-danger'></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-secondary mr-4" data-toggle="pill" href="#menu3"><b> QF-PCR (ส่งต่อ)
                        </b>
                        <span class='badge  badge-danger'></span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div id="home" class="tab-pane active"><br>
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mt-2 mb-4">รายงานระยะเวลาการตรวจวิเคราะห์ Karyotype สิ่งส่งตรวจน้ำคร่ำ</h2>
                    <div class="row justify-content-center">
                        <div class="col-sm-8 ">
                            <form action="{{ route('export.amniotic') }}" method="GET">
                                <div class="input-group  ">

                                    <input type="date" name="from_date_amni" id="from_date_amni" class="form-control "
                                        autocomplete="off"  />
                                    <div class="col-sm-2 text-center pt-2">
                                        <h6>ถึงวันที่</h6>
                                    </div>
                                    <input type="date" name="to_date_amni" id="to_date_amni" class="form-control"
                                        autocomplete="off"  />

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success  "><i class="fas fa-download"></i>
                                            Excel</button>
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   


    <div id="menu1" class="tab-pane fade"><br>
    <div class="card">
                <div class="card-body">
                    <h2 class="text-center mt-2 mb-4">รายงานระยะเวลาการตรวจวิเคราะห์ Karyotype สิ่งส่งตรวจเลือด</h2>
                    <div class="row justify-content-center">
                        <div class="col-sm-8 ">
                            <form action="#" method="GET">
                                <div class="input-group  ">

                                    <input type="date" name="from_date" id="from_date" class="form-control "
                                        autocomplete="off" placeholder="เลือกวันที่เริ่ม" />
                                    <div class="col-sm-2 text-center pt-2">
                                        <h6>ถึงวันที่</h6>
                                    </div>
                                    <input type="date" name="to_date" id="to_date" class="form-control"
                                        autocomplete="off" placeholder="เลือกวันที่สุดท้าย" />

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success  "><i class="fas fa-download"></i>
                                            Excel</button>
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div id="menu2" class="tab-pane fade"><br>
    <div class="card">
                <div class="card-body">
                    <h2 class="text-center mt-2 mb-4">รายงานระยะเวลาการตรวจวิเคราะห์ QF-PCR</h2>
                    <div class="row justify-content-center">
                        <div class="col-sm-8 ">
                            <form action="#" method="GET">
                                <div class="input-group  ">

                                    <input type="date" name="from_date" id="from_date" class="form-control "
                                        autocomplete="off" placeholder="เลือกวันที่เริ่ม" />
                                    <div class="col-sm-2 text-center pt-2">
                                        <h6>ถึงวันที่</h6>
                                    </div>
                                    <input type="date" name="to_date" id="to_date" class="form-control"
                                        autocomplete="off" placeholder="เลือกวันที่สุดท้าย" />

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success  "><i class="fas fa-download"></i>
                                            Excel</button>
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div id="menu3" class="tab-pane fade"><br>
    <div class="card">
                <div class="card-body">
                    <h2 class="text-center mt-2 mb-4">รายงานระยะเวลาการตรวจวิเคราะห์ QF-PCR(ส่งต่อ)</h2>
                    <div class="row justify-content-center">
                        <div class="col-sm-8 ">
                            <form action="#" method="GET">
                                <div class="input-group  ">

                                    <input type="date" name="from_date" id="from_date" class="form-control "
                                        autocomplete="off" placeholder="เลือกวันที่เริ่ม" />
                                    <div class="col-sm-2 text-center pt-2">
                                        <h6>ถึงวันที่</h6>
                                    </div>
                                    <input type="date" name="to_date" id="to_date" class="form-control"
                                        autocomplete="off" placeholder="เลือกวันที่สุดท้าย" />

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success  "><i class="fas fa-download"></i>
                                            Excel</button>
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>

@endsection