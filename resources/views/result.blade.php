@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container">
    <div class="row mt-4">
        <div class="col-md-9  ">
            <ul class="nav nav-pills mx-auto" role="tablist">
                <li class="nav-item ">
                    <a class="nav-link nev-link-success active" data-toggle="pill" href="#home"><b> Karyotype น้ำคร่ำ
                        </b><span class='badge  badge-danger'>{{count($amniotics)}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nev-link-success " data-toggle="pill" href="#menu1"><B>Karyotype เลือด </B><span
                            class='badge  badge-danger'>{{count($bloods)}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nev-link-success " data-toggle="pill" href="#menu2"><b>ผลตรวจ QF-PCR </b> <span
                            class='badge  badge-danger'>{{count($pcrs)}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nev-link-success" data-toggle="pill" href="#menu3"><b>ผลตรวจ QF-PCR (ส่งต่อ) </b>
                        <span class='badge  badge-danger'>{{count($senteds)}}</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div id="home" class="tab-pane active"><br>
            <div class="row">
                <div class="col-sm-7 mb-4">
                    <h3 class="d-inline-block align-middle">ผลตรวจ karyotype น้ำคร่ำ</h3>
                </div>
                <div include="form-input-select()" class="col-sm-4 mb-4">
                    <form action="resultamni" method="GET">
                        <input type="text" class="form-control" name="search_amni" placeholder="ค้นรายชื่อ" />
                </div>
                <div class="col-md-1 mb-4">
                    <button type="submit" class="btn btn-primary ">ค้นหา</button>
                </div>

                </form>

            </div>
            @if(count($amniotics)>0)
            <table id="patTable" class="table table-hover table-sm  ">
                <thead>
                    <tr>
                        <th>วันที่รับตัวอย่าง</th>
                        <th>Lab number</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>หน่วยงาน</th>
                        <th>ผลตรวจ</th>
                        <th>ระยะเวลารายงานผล</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($amniotics as $amniotic )
                <tr>
                        <td> {{$amniotic->created_at->format('d/m/Y')}}</td>
                        <td> {{$amniotic->lab_no}}</td>
                        <td> {{$amniotic->pt_name}}</td>
                        <td> {{$amniotic->pt_add}}</td>
                        <td>
                        @if (is_null($amniotic->pcr_sent))
                            @if (is_null($amniotic->karyo_result))
                            <span id="datecount" style="color: red;"> รอผลตรวจ</span>
                            @else
                            {{$amniotic->karyo_result}}
                            @endif
                        @else
                        <span> ส่งต่อ QF-PCR</span>
                        @endif
                        </td>
                        <td> @if (is_null($amniotic->karyo_result))
                       
                        @else
                        {{\Carbon\Carbon::parse($amniotic->created_at)->diffInDays($amniotic->updated_at)}} วัน @endif</td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <h2>ยังไม่มีรายการตรวจ</h2>
            @endif

        </div>

        <div id="menu1" class="tab-pane fade"><br>
            <div class="row">
                <div class="col-sm-7  mb-4">
                    <h3 class="d-inline-block align-middle">ผลตรวจ karyotype เลือด</h3>
                </div>
                <div include="form-input-select()" class="col-sm-4 mb-4 ">
                    <form action="resultamni" method="GET">
                        <input type="text" class="form-control" name="search_blood" placeholder="ค้นรายชื่อ" />
                </div>
                <div class="col-md-1 mb-4">
                    <button type="submit" class="btn btn-primary ">ค้นหา</button>
                </div>

                </form>

            </div>
            @if(count($bloods)>0)
            <table id="patTable" class="table table-hover table-sm  ">
                <thead>
                    <tr>
                        <th>วันที่รับตัวอย่าง</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>หน่วยงาน</th>
                        <th>รายการตรวจ</th>
                        <th>ผลตรวจ</th>
                        <th>ระยะเวลารายงานผล</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($bloods as $blood )
                <tr>
                        <td> {{$blood->created_at->format('d/m/Y')}}</td>
                        <td> {{$blood->lab_no}}</td>
                        <td> {{$blood->pt_name}}</td>
                        <td> {{$blood->pt_add}}</td>
                        <td>
                        @if (is_null($blood->pcr_sent))
                            @if (is_null($blood->karyo_result))
                            <span id="datecount" style="color: red;"> รอผลตรวจ</span>
                            @else
                            {{$blood->karyo_result}}
                            @endif
                        @else
                        <span> ส่งต่อ QF-PCR</span>
                        @endif
                        </td>
                        <td> @if (is_null($blood->karyo_result))
                       
                        @else
                        {{\Carbon\Carbon::parse($blood->created_at)->diffInDays($blood->updated_at)}} วัน @endif</td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <h2>ยังไม่มีรายการตรวจ</h2>
            @endif
        </div>
        <div id="menu2" class="tab-pane fade"><br>
            <div class="row">
                <div class="col-sm-7 mb-4">
                    <h3 class="d-inline-block align-middle">ผลตรวจ QF-PCR</h3>
                </div>
                <div include="form-input-select()" class="col-sm-4 mb-4 ">
                    <form action="resultamni" method="GET">
                        <input type="text" class="form-control" name="search_pcr" placeholder="ค้นรายชื่อ" />
                </div>
                <div class="col-md-1 mb-4">
                    <button type="submit" class="btn btn-primary ">ค้นหา</button>
                </div>

                </form>

            </div>
            @if(count($bloods)>0)
            <table id="patTable" class="table table-hover table-sm  ">
                <thead>
                    <tr>
                        <th>วันที่รับตัวอย่าง</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>หน่วยงาน</th>
                        <th>รายการตรวจ</th>
                        <th>ผลตรวจ</th>
                        <th>ระยะเวลารายงานผล</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pcrs as $pcr )
                <tr>
                        <td> {{$pcr->created_at->format('d/m/Y')}}</td>
                        <td> {{$pcr->lab_no}}</td>
                        <td> {{$pcr->pt_name}}</td>
                        <td> {{$pcr->pt_add}}</td>
                        <td>
                       
                            @if (is_null($pcr->pcr_result))
                            <span id="datecount" style="color: red;"> รอผลตรวจ</span>
                            @else
                            {{$pcr->pcr_result}}
                            @endif

                        </td>
                        <td> @if (is_null($pcr->pcr_result))
                       
                        @else
                        {{\Carbon\Carbon::parse($pcr->created_at)->diffInDays($pcr->updated_at)}} วัน @endif</td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <h2>ยังไม่มีรายการตรวจ</h2>
            @endif
        </div>
        <div id="menu3" class="tab-pane fade"><br>
            <div class="row">
                <div class="col-sm-7 mb-4">
                    <h3 class="d-inline-block align-middle">ผลตรวจ QF-PCR (ส่งต่อ)</h3>
                </div>
                <div include="form-input-select()" class="col-sm-4 mb-4">
                    <form action="findtest" method="GET">
                        <input type="text" class="form-control" name="search_sent" placeholder="ค้นรายชื่อ" />
                </div>
                <div class="col-md-1 mb-4">
                    <button type="submit" class="btn btn-primary ">ค้นหา</button>
                </div>

                </form>

            </div>
            @if(count($bloods)>0)
            <table id="patTable" class="table table-hover table-sm  ">
                <thead>
                    <tr>
                        <th>วันที่รับตัวอย่าง</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>หน่วยงาน</th>
                        <th>รายการตรวจ</th>
                        <th>ผลตรวจ</th>
                        <th>ระยะเวลารายงานผล</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($senteds as $sented )
                <tr>
                        <td> {{$sented->created_at->format('d/m/Y')}}</td>
                        <td> {{$sented->lab_no}}</td>
                        <td> {{$sented->pt_name}}</td>
                        <td> {{$sented->pt_add}}</td>
                        <td>
                        
                            @if (is_null($pcr->pcr_result))
                            <span id="datecount" style="color: red;"> รอผลตรวจ</span>
                            @else
                            {{$sented->pcr_result}}
                            @endif
                       
                        </td>
                        <td> @if (is_null($sented->pcr_result))
                       
                        @else
                        {{\Carbon\Carbon::parse($sented->created_at)->diffInDays($sented->updated_at)}} วัน @endif</td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <h2>ยังไม่มีรายการตรวจ</h2>
            @endif
        </div>
</div>

</div>

    @endsection