<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบจัดการงานโครโมโซม</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit&family=Prompt:wght@300&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="shortcut icon" href="{{ asset('cricon.ico') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<style>
  .container-xl {
    max-width: 1700px;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    font-family: 'Sarabun', sans-serif;
 }
  .container {
    
    font-family: 'Sarabun', sans-serif;
 }
  .container-xs {
    max-width: 800px;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    font-family: 'Sarabun', sans-serif;
 }
 .navbar-expand-sm .navbar-nav .nav-link {
    /* color: rgba(255, 255, 255, 1); */
    padding-right: 1rem;
    padding-left: 1rem;
    font-family: 'Kanit', sans-serif;
    
    }
    .table-sm td, .table-sm th {
    padding: .4rem;
    vertical-align: middle;
}
.dot {
  height: 10px;
  width: 10px;
  background-color: #EC7063;
  border-radius: 50%;
  display: inline-block;
}
.dot-y {
  height: 10px;
  width: 10px;
  background-color: #F4D03F ;
  border-radius: 50%;
  display: inline-block;
}
.display-xl {
    font-size: 4rem;
    font-weight: 800;
    line-height: .8;
}
</style>
<script>
$(document).ready(function()
                  {
                  $("#test_type").change(function()
        {
            if($(this).val() == "Karyotyping")
        {
            $("#karyotype_id").show();
        }
        else
        {
            $("#karyotype_id").hide();
        }
            });
                      $("#karyotype_id").hide();
});
$(document).ready(function()
                  {
                  $("#test_type").change(function()
        {
            if($(this).val() == "Combo")
        {
            $("#combo_id").show();
        }
        else
        {
            $("#combo_id").hide();
        }
            });
                      $("#combo_id").hide();
});
$(document).ready(function()
                  {
                  $("#test_type").change(function()
        {
            if($(this).val() == "QF-PCR")
        {
            $("#qfpcr_id").show();
        }
        else
        {
            $("#qfpcr_id").hide();
        }
            });
                      $("#qfpcr_id").hide();
});
$(document).ready(function(){
  $(".comboCheck").change(function()
        {
            if($(this).val() == "1")
        {
            $(".combo").toggle();
        }
        else
        {
            $(".combo").hide();
        }
      });
$(".combo").hide();
});

</script>
</head>
<body>
<nav class="navbar navbar-expand-sm sticky-top navbar-light bg-white shadow-sm">
<a class="navbar-brand" href="home">
 <img src="{{URL::asset('/image/Chromologo3.png')}}" alt="profile Pic" height="30"
                                width="106" ></a>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
  <div class="navbar-nav">
      <a class="nav-item nav-link " href="home"><i class="fas fa-home"></i> &nbsp;หน้าหลัก</a>
      <a class="nav-item nav-link " href="receive"><i class="fas fa-book-medical"></i> &nbsp;รับสิ่งส่งตรวจ</a>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-file-medical"></i> &nbsp;บันทึกรายการตรวจ
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="amniotic"><i class="fas fa-syringe"></i>&nbsp;&nbsp;&nbsp;&nbsp;น้ำคร่ำ</a>
          <a class="dropdown-item" href="#"><i class="fas fa-vial"></i>&nbsp;&nbsp;&nbsp;&nbsp;เลือด</a>
          <a class="dropdown-item" href="#"><i class="fas fa-dna"></i>&nbsp;&nbsp;&nbsp;&nbsp;QF-PCR</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><i class="fas fa-ambulance"></i>&nbsp;&nbsp;&nbsp;&nbsp;ส่งต่อ QF-PCR</a>
        </div>
        </li>
      <a class="nav-item nav-link " href="#"><i class="fas fa-notes-medical"></i> &nbsp;ผลตรวจวิเคราะห์</a>
      <a class="nav-item nav-link " href="hospital"><i class="fas fa-clinic-medical"></i> &nbsp;เพิ่มหน่วยงาน</a>
      <a class="nav-item nav-link " href="#"><i class="far fa-chart-bar"></i> &nbsp;สรุป</a>
    </div>
    </div>
</nav>
    @yield('main')

    
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>