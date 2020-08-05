@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container-md">

    @if(count($tlcsums)>0)
    <div class="row justify-content-end">
     <div class="col-sm-5">
        <form class="form-inline" action="{{ route('export.tlc') }}" method="GET">
            <div class="form-group my-3">
            <input type="date" name="date_from" class="form-control" value="{{$tlc_fisrt->created_at->format('Y-m-d')}}" />
            </div>
            <span class ="ml-2">ถึง</span>
            <div class="form-group mx-sm-3 my-3">
            <input type="date" name="date_to" class="form-control" value="{{$tlc_fisrt->created_at->format('Y-m-d')}}" />
            </div>
            <div class="form-group mx-sm-3 my-3">
            <button type="submit" class="btn btn-success btn-block ">Download</button>
            </div>
           
        </form>
        </div>
        @include('sumary.tabletlc', $tlcsums)




    </div>
    @elseif(count($tlcsums)==0)
    <div class="row text-center  justify-content-center mt-4 mb-3">
    <h2 >สรุปจำนวนโลจิสติก TLC</h2> 
    
    </div>
    <div class="row text-center  justify-content-center mt-4 mb-3">
    <h5 class="mb-3">เลือกช่วงวันที่ที่ต้องการสรุป</h5>
        <div class="col-md-12  ">
            <form action="{{ route('tlc.filter') }}" method="GET">
                <div class="input-group  text-center  justify-content-center">

                    <div class="col-sm-2">
                    <input type="date" name="date_from" class="form-control"/>
                    </div>
                    <div class="col-sm-2">
                    <input type="date" name="date_to" class="form-control"/>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary btn-block ">สรุป</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @endif
</div>

@endsection