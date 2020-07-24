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
        @foreach($sumrecive as $sum)
            <tr>
                <td>{{$sum->created_at->format('d/m/Y')}}</td>
                <td> {{$sum->chromo_number}}</td>
                <td>{{$sum->chromo_name}}</td>
                <td> {{$sum->chromo_doc}}</td>
                <td> {{$sum->chromo_hos}}</td>
                <td> {{$sum->sample_type}}</td>
                <td> {{$sum->chromo_test}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
               <tr>
               
               <td colspan="5" class="text-right"><b>รวม</b> </td>
               <td id="sumtime" class="text-center"><b>{{ count($sumrecive)}}</b> </td>
               <td class="text-center"><b>ตัวอย่าง</b> </td>
               </tr>
        </tfoot> 
    </table>