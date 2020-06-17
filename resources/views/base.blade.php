<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบจัดการงานโครโมโซม</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<style>
  .container-xl {
    max-width: 1700px;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
 }
 .navbar-expand-sm .navbar-nav .nav-link {
    color: rgba(255, 255, 255, 1);
    padding-right: 1rem;
    padding-left: 1rem;
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
</script>
</head>
<body>
<nav class="navbar navbar-expand-sm sticky-top navbar-dark bg-dark shadow-sm">
 <img src="{{URL::asset('/image/Chromosome logo.png')}}" alt="profile Pic" height="80"
                                width="120">
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
  <div class="navbar-nav">
      <a class="nav-item nav-link " href="receive"><i class="fas fa-book-medical"></i> &nbsp;รับสิ่งส่งตรวจ</a>
      <a class="nav-item nav-link " href=""><i class="fas fa-file-medical"></i> &nbsp;บันทึกรายการตรวจ</a>
      <a class="nav-item nav-link " href=""><i class="fas fa-clinic-medical"></i> &nbsp;เพิ่มหน่วยงาน</a>
      <a class="nav-item nav-link " href=""><i class="far fa-chart-bar"></i> &nbsp;สรุป</a>
    </div>
    </div>
</nav>
    @yield('main')
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>