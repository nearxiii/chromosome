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
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($monthlysums as $month)
            <tr>
                <td>{{$month->created_at->format('d/m/Y')}}</td>
                <td> {{$month->chromo_number}}</td>
                <td>{{$month->chromo_name}}</td>
                <td> {{$month->chromo_doc}}</td>
                <td> {{$month->chromo_hos}}</td>
                <td> {{$month->sample_type}}</td>
                <td> {{$month->chromo_test}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
               <tr>
               
               <td colspan="5" class="text-right"><b>รวม</b> </td>
               <td id="sumtime" class="text-center"><b>{{ count($monthlysums)}}</b> </td>
               <td class="text-center"><b>ตัวอย่าง</b> </td>
               </tr>
        </tfoot> 
    </table>