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
    </div>


    <!-- Modal add-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
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

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                            @endif
                            <form method="post" action="{{ route('receive.store') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="date" class="form-control" name="created_at"
                                        value="<?php echo date("Y-m-d");?>" placeholder="วันที่" /></div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="chromo_name"
                                        placeholder="ชื่อ-นามสกุล" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="chromo_doc" placeholder="แพทย์" />

                                </div>


                                <div include="form-input-select()">
                                    <select required class="custom-select mb-3" name="chromo_hos">
                                        <option selected>เลือกหน่วยงาน</option>
                                        @foreach($hoslist as $hos)
                                        <option value="{{$hos->hos_short}}">{{$hos->hos_name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="row">
                                    <div include="form-input-select()" class="col-sm-6">
                                        <select required class="custom-select mb-3" name="sample_type">
                                            <option selected>ชนิดสิ่งส่งตรวจ</option>
                                            <option value="น้ำคร่ำ">น้ำคร่ำ</option>
                                            <option value="เลือด">เลือด</option>
                                            <option value="DNA">DNA</option>
                                        </select>
                                    </div>
                                    <div include="form-input-select()" class="col-sm-6">
                                        <select required class="custom-select mb-3" name="chromo_test" id="test_type">
                                            <option selected>รายการตรวจ</option>
                                            <option value="Karyotyping">Karyotyping</option>
                                            <option value="QF-PCR">QF-PCR</option>
                                            <option value="Combo">Combo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label id="karyotype_id">Lab number ที่ใช้ล่าสุด : <span class="text-danger"> <b>
                                                {{ $karyotype_no->chromo_number}} </b></span></label>
                                    <label id="qfpcr_id">Lab number ที่ใช้ล่าสุด :<span class="text-danger">
                                            <b>{{ $pcr_no->chromo_number}} </b></span> </label>
                                    <label id="combo_id">Lab number ที่ใช้ล่าสุด : <span class="text-danger">
                                            <b>{{ $combo_no->chromo_number}}</b> </span></label>
                                    <input type="text" class="form-control" name="chromo_number"
                                        placeholder="Lab Number" />
                                </div>
                                <div include="form-input-select()" id="medtech">
                                    <select required class="custom-select mb-3" name="rev_staff">
                                        <option selected>ผู้รับ</option>
                                        <option value="อมรรัตน์">อมรรัตน์</option>
                                        <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                        <option value="ฉัตรลดา">ฉัตรลดา</option>
                                    </select>
                                </div>
                                <div include="form-input-select()" id="medtech">
                                    <select required class="custom-select mb-3" name="logis_staff">
                                        <option selected>โลจิสติกส์</option>
                                        <option value="อมรรัตน์">อมรรัตน์</option>
                                        <option value="ชัชวิชญ์">ชัชวิชญ์</option>
                                        <option value="ฉัตรลดา">ฉัตรลดา</option>
                                    </select>
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
                <th>remark</th>
                <th colspan=2 width="3%">Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach($chromos as $Chromosome)
            <tr>
                <td>{{$Chromosome->created_at->format('d/m/Y')}}</td>
                <td>{{$Chromosome->chromo_name}}</td>
                <td>{{$Chromosome->chromo_doc}}</td>
                <td>{{$Chromosome->chromo_hos}}</td>
                <td>
                    {{$Chromosome->sample_type}}

                </td>
                <td>

                    <?php
                    if($Chromosome['chromo_test']=="Karyotyping")
                        {echo "<span class='badge badge-pill badge-primary'>Karyotyping</span>";}
                          elseif($Chromosome['chromo_test']=="QF-PCR")
                            {echo "<span class='badge badge-pill badge-success'>QF-PCR</span>";}
                          elseif($Chromosome['chromo_test']=="Combo")
                            {echo "<span class='badge badge-pill badge-warning'>Combo</span>";}
                           
                  ?>
                </td>
                <td>{{$Chromosome->logis_staff}}</td>

                <td>{{$Chromosome->logis_staff}}</td>
                <td>
                    @if (is_null($Chromosome->report_date))
                    <span id="datecount" style="color: red;"> รอผลตรวจ</span>
                    @else
                    {{date('d-m-Y', strtotime($Chromosome->report_date))}}
                    @endif
                </td>
                <td>
                    @if (is_null($Chromosome->email_date))
                    <span id="datecount" style="color: red;"> รอผลตรวจ</span>
                    @else
                    {{date('d-m-Y', strtotime($Chromosome->email_date))}}
                    @endif
                </td>
                <td>{{$Chromosome->chromo_number}}</td>
                <td>{{$Chromosome->chromo_remark}}</td>
                <td>
                    <a href="{{ route('receive.edit',$Chromosome->id)}}" class="btn btn-sm btn-outline-info"
                        data-toggle="modal" data-target="#editModal{{ $Chromosome->id }}"><i
                            class="far fa-edit"></i></a>
                </td>
                <td>
                    <form action="{{ route('receive.destroy', $Chromosome->id)}}" method="post"
                        style="margin-block-end: 0px;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" type="submit"><i
                                class="far fa-trash-alt"></i></button>
                    </form>
                </td>

            </tr>
            <!-- Modal edit-->
            <div class="modal fade" id="editModal{{ $Chromosome->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
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
                                    <p> ชื่อ - สกุล : <b>{{$Chromosome->chromo_name}}</b><br>
                                        หน่วยงาน :<b> {{$Chromosome->chromo_hos}}</b></p>
                                    <form method="post" action="{{ route('receive.update', $Chromosome->id) }}">
                                        @method('PATCH')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">วันที่รายงาน</label>
                                                    <input type="date" class="form-control" name="report_date"
                                                        value="<?php echo date("Y-m-d");?>" placeholder="วันที่" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">วันที่ส่ง email</label>
                                                    <input type="date" class="form-control" name="email_date"
                                                        value="<?php echo date("Y-m-d");?>" placeholder="วันที่" />
                                                </div>
                                            </div>
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
            @endforeach
        </tbody>
    </table>
</div>



@endsection