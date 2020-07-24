@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container-md">
    <div class="row text-center  justify-content-center mt-4 mb-3">
        <div class="col-md-12  ">
            <form action="{{ route('sum.filter') }}" method="GET">
                <div class="input-group  text-center  justify-content-center">
                    <div class="col-sm-4">
                        <select  class="custom-select " name="search_hospital">
                            <option value="">เลือกหน่วยงาน</option>
                            @foreach($hoslist as $hos)
                            <option value="{{$hos->hos_short}}">{{$hos->hos_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control lab_name" name="search_month" id="search">
                            <option value=" ">เลือกเดือน</option>
                            <option value="01">มกราคม</option>
                            <option value="02">กุมภาพันธ์</option>
                            <option value="03">มีนาคม</option>
                            <option value="04">เมษายน</option>
                            <option value="05">พฤษภาคม</option>
                            <option value="06">มิถุนายน</option>
                            <option value="07">กรกฎาคม</option>
                            <option value="08">สิงหาคม</option>
                            <option value="09">กันยายน</option>
                            <option value="10">ตุลาคม</option>
                            <option value="11">พฤศจิกายน</option>
                            <option value="12">ธันวาคม</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control lab_name" name="search_years" id="search">
                            <option value=" ">เลือกปี</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary btn-block ">สรุป</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    @if(count($sumrecive)>0)
    <div class="row">
        <div class="col-9">
            @include('sumary.table', $sumrecive)
        </div>
        <div class="col-2">

            <form action="{{ route('export.summary') }}" method="GET">
                <div class="  text-center  justify-content-center">
                    <div class="col mb-2">
                        <input type="text" class="form-control" name="search_hospital" id="hos"
                            value="{{ ($sumsent_ex->chromo_hos)}}" />
                    </div>
                    <div class="col mb-2">
                        <input type="text" class="form-control" name="search_month" id="month"
                            value="{{ ($sumsent_ex->created_at->format('m'))}}" />
                    </div>
                    <div class="col mb-2">
                        <input type="text" class="form-control" name="search_years" id="years"
                            value="{{ ($sumsent_ex->created_at->format('Y'))}}" />
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-block ">Download</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @elseif(count($sumrecive)==0)
    <div id="chart"></div>
    @endif

</div>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
var ria = <?php echo json_encode($ria)?> ;
var hos_7 = <?php echo json_encode($hos_7) ?> ;
var bmg = <?php echo json_encode($bmg) ?> ;
var hos_sri = <?php echo json_encode($hos_sri) ?> ;
var hos_pon = <?php echo json_encode($hos_pon) ?> ;
var hos_kala = <?php echo json_encode($hos_kala) ?> ;
var hos_chom = <?php echo json_encode($hos_chom) ?> ;
var doc_pee = <?php echo json_encode($doc_pee) ?> ;


Highcharts.chart('chart', {
    title: {
        text: 'กราฟยอดส่งตรวจตามหน่วยงาน'
    },
    chart: {
        type: 'column'
    },

    xAxis: {
        categories: ['มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']
    },
    yAxis: {
        title: {
            text: 'จำนวนที่ส่งตรวจ'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            connectNulls: true,
        }
    },
    series: [{
        name: 'RIA Lab',
        color: '#48C9B0',
        data: ria
    }, {
        name: 'ศูนย์อนามัยที่ 7',
        color: '#EC7063',
        data: hos_7

    }, {
        name: 'บริษัทกรุงเทพอณูพันธุศาสตร์ ',
        color: '#F5B041 ',
        data: bmg

    }, {
        name: 'รพ.ศรีนครินทร์',
        color: '#85C1E9',
        data: hos_sri

    }, {
        name: 'รพ.พล',
        color: '#A569BD',
        data: hos_pon

    }, {
        name: 'รพ.กาฬสินธุ์',
        color: '#117A65',
        data: hos_kala

    }, {
        name: 'รพ.ชุมแพ',
        color: '#A04000',
        data: hos_chom

    }, {
        name: 'คลินิกหมอพีระยุทธิ์',
        color: '#2E4053',
        data: doc_pee
    }]

});

</script>
@endsection