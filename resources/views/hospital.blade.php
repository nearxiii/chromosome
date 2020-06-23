@extends('base')
<!-- navbar -->

<!-- end navbar -->
@section('main')

<div class="container-xs">
    <div class="row">
        <div class="col-sm-12">

            <h3 class="d-inline-block align-middle" style="margin-top: 1rem; margin-bottom: 1.5rem" >รายการหน่วยงานที่ส่งตรวจโครโมโซม</h3> 
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal" style="margin: 19px; "><i class="fas fa-plus"></i>
                เพิ่มหน่วยงาน
                </button>
        </div>   
            <div class="col-sm-12">
             @if(session()->get('success'))
                <div class="alert alert-success">
                {{ session()->get('success') }}  
                </div>
                @endif
            </div>
    </div>
           

    <!-- Modal add-->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-success" style="margin: 0 auto; " id="addModalLabel">เพิ่มหน่วยงาน</h3>
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
                                <form method="post" action="{{ route('hospital.store') }}">
                                    @csrf
                                   
                                    <div class="form-group">    
                                        <input type="text" class="form-control" name="hos_short" placeholder="ชื่อย่อหน่วยงาน" autocomplete="off"/>
                                    </div>
                                    <div class="form-group">    
                                        <input type="text" class="form-control" name="hos_name" placeholder="ชื่อเต็มหน่ยงาน" autocomplete="off"/>
                                    </div>

                                         
                                        <div class="modal-footer">                
                                        <button type="submit" class="btn btn-success btn-lg btn-block ">บันทึก</button><br />
                                        
                                        </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

    
            <!-- end moal add -->

                
    
      <table id="patTable" class="table table-bordered ">
            <thead >
                <tr class="bg-primary text-white">
                <th>ชื่อย่อ</th>
                <th>ชื่อเต็ม</th>
                </tr>
            </thead>
        <tbody>
        @foreach($hospitals as $hos)
            <tr>
              
                <td >{{$hos->hos_short}}</td>
                <td >{{$hos->hos_name}}</td>
               

            </tr>
            @endforeach
        </tbody>
      </table>        
</div>

@endsection