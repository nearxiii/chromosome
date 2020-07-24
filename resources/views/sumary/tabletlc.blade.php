<table id="patTable" class="table table-hover table-sm  ">
        <thead>
            <tr>
                <th>วันที่รับตัวอย่าง</th>
                <th>LabNumber</th>
                <th>ชื่อ-นามสกุล</th>
                <th>แพทย์</th>
                <th>หน่วยงาน</th>
                <th>สิ่งส่งตรวจ</th>
                <th>รายการตรวจ</th>
                <th>โลจิสติกส์</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($tlcsums as $tlc)
            <tr>
                <td>{{$tlc->created_at->format('d/m/Y')}}</td>
                <td> {{$tlc->chromo_number}}</td>
                <td>{{$tlc->chromo_name}}</td>
                <td> {{$tlc->chromo_doc}}</td>
                <td> {{$tlc->chromo_hos}}</td>
                <td> {{$tlc->sample_type}}</td>
                <td> {{$tlc->chromo_test}}</td>
                <td> {{$tlc->logis_staff}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
               <tr>
               
               <td colspan="6" class="text-right"><b>รวม</b> </td>
               <td id="sumtime" class="text-center"><b>{{ count($tlcsums)}}</b> </td>
               <td class="text-center"><b>ตัวอย่าง</b> </td>
               </tr>
        </tfoot> 
    </table>