<?php
session_start();
include('includes/config.php');
//$_SESSION['login'];
//error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
header('location:index.php');
}
else{
?>
<?php include("head.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<?php 
include("loader.php"); 
?>

<!--**********************************
Main wrapper start
***********************************-->
<div class="wrapper">
    <?php include("nav_header.php"); ?>
    <?php include("header.php");?>
    <?php include("sidebar.php");?>
    
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
                <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box bg-light-primary">
                      <span class="info-box-icon"><i class="typcn typcn-group-outline"></i></span>
        
                        <?php  
  //                        $id=$_SESSION['login_id'];
  //                                            if($_SESSION['role']=='admin'){
  //                                               $query=mysqli_query($con,"select admission.id as 'id', sname
  // ,dob 
  // ,classname.name as'cla'   ,fquali          ,fname         ,foccu         ,fincome         ,mquali         ,mname         ,moccu  
  //      ,mincome          ,address         ,ophone         ,rphone         ,fbro        ,fbro2         ,fbro3         ,fbro4         ,bplace  
  //      ,mtongue         ,reli        ,cast         ,pschool         ,hos         ,bank         ,dd         ,issu,gen,email,regisdate,
  //      finalsub,        allcomp,       groupc,
  //             optional , paytype from admission, classname  where admission.cla=classname.id   order by admission.id desc");
  //                                            }
  //                                            else{
  //                                                $query=mysqli_query($con,"select * from admission where session_id='$id'");
  //                                            }
  //                      $rowcount=mysqli_num_rows($query);
  $rowcount=1;
  ?>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Student</span>
                        <span class="info-box-number"><?php echo $rowcount;?> &nbsp;</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-light-warning">
                      <span class="info-box-icon"><i class="typcn typcn-mail"></i></span>
                       <?php  
                      //  $id=$_SESSION['login_id'];
                      //                        if($_SESSION['role']=='admin'){
                      //                           $query=mysqli_query($con,"select * from feedback");
                      //                        }
                      //                        else{
                      //                            $query=mysqli_query($con,"select * from feedback ");
                      //                        }
                      //  $rowcount=mysqli_num_rows($query);?>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Feedback</span>
                        <span class="info-box-number"><?php echo $rowcount;?> &nbsp;</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
        
                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>
        
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-light-accent">
                      <span class="info-box-icon"><i class="typcn typcn-group-outline"></i></span>
                       <?php  
                        
                       ?>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Registered Alumni</span>
                        <span class="info-box-number"><?php echo $rowcount;?> &nbsp;</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-light-error">
                      <span class="info-box-icon" style='margin-top: 20px'><i class="fas fa-chalkboard-teacher"></i></span>
                     <?php  
                    ?>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Faculty</span>
                        <span class="info-box-number"><?php echo $rowcount;?> &nbsp;</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                
          
              
            </div>
            <!-- /.row -->
            
            <!-- Main row -->
          
            
            
    
          </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
      </div>
    <!-- /.content-wrapper -->
    
    
    <!--**********************************
    Content body start
    ***********************************-->
    <!--**********************************
    Content body end
    ***********************************-->
  
    
    <!--**********************************
    Footer start
    ***********************************-->
    <?php include("footer.php"); ?>
    <!--**********************************
    Footer end
    ***********************************-->
</div>
<!--**********************************
Main wrapper end
***********************************-->
<!--**********************************
Scripts
***********************************-->

<?php include("script.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    <?php
    // Fetch browser counts from the database
    $query = mysqli_query($con, "SELECT browser, COUNT(*) as count FROM visitor GROUP BY browser");
    $browserCounts = array();
    $includedBrowsers = ["Chrome", "Safari", "Firefox", "Mobi"];

    while ($row = mysqli_fetch_array($query)) {
        $browserName = $row['browser'];
        // Extract the browser name without version or other details
        if (stripos($browserName, "Chrome") !== false) {
            $browserName = "Chrome";
        } elseif (stripos($browserName, "Safari") !== false) {
            $browserName = "Safari";
        } elseif (stripos($browserName, "Firefox") !== false) {
            $browserName = "Firefox";
        } elseif (stripos($browserName, "Mobi") !== false) {
            $browserName = "Mobi";
        } else {
            $browserName = "Other"; // Group excluded browsers as "Other"
        }

        if (!isset($browserCounts[$browserName])) {
            $browserCounts[$browserName] = 0;
        }
        $browserCounts[$browserName] += $row['count'];
    }

    // Prepare the JavaScript arrays for xValues, yValues, and barColors
    $xValues = [];
    $yValues = [];
    $barColors = [];

    // Define colors for each browser
    $browserColors = [
        "Chrome" => "#b91d47",
        "Safari" => "#00aba9",
        "Firefox" => "#2b5797",
        "Mobi" => "#e8c3b9",
        "Other" => "#ffc107" // Color for the "Other" category
    ];

    // Populate the arrays with browser names, counts, and colors
    foreach ($browserCounts as $browserName => $count) {
        $xValues[] = $browserName;
        $yValues[] = $count;
        $barColors[] = $browserColors[$browserName];
    }
    ?>

    var xValues = <?php echo json_encode($xValues); ?>;
    var yValues = <?php echo json_encode($yValues); ?>;
    var barColors = <?php echo json_encode($barColors); ?>;

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Browser Usage"
            }
        }
    });
</script>

</body>
</html>
<?php } ?>