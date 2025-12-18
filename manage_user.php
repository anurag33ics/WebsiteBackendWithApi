<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
header('location:index.php');
}
else{
if($_GET['action']=='del')
{
$postid=intval($_GET['id']);
//echo "DELETE FROM tbladminblog WHERE id ='$postid'";
$query=mysqli_query($con,"DELETE FROM admin WHERE id ='$postid'");
if($query)
{
$msg="Post deleted ";
}
else{
$error="Something went wrong . Please try again.";
}
}
?>
<?php include("head.php") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<?php include("loader.php"); ?>
<!--**********************************
Main wrapper start
***********************************-->
<div class="wrapper">
    
    <?php include("nav_header.php"); ?>
    <?php include("header.php");?>
    <?php include("sidebar.php");?>
    
    <!--**********************************
    Content body start
    ***********************************-->
    <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Admin Data</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Manage User</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div>
        </div>
        <!-- row -->
        <section class="content">
            <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage User</h3>
                            <div class="card-tools">
                                <a href="add_user.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add User</a>
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!---Success Message--->
                                        <?php if($msg){ ?>
                                        <div class="alert alert-success" role="alert">
                                            <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                        </div>
                                        <?php } ?>
                                        <!---Error Message--->
                                        <?php if($error){ ?>
                                        <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="table-new">
                                    <div class="table-responsive">
                                    <table id="example1" class="table table-bordered m-0 zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Role Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query=mysqli_query($con,"select * from admin");
                                        $cnt=1;
                                        $rowcount=mysqli_num_rows($query);
                                        if($rowcount==0)
                                        {
                                        ?>
                                        <tr>
                                            <td colspan="4" align="center"><h3 style="color:red">No record found</h3></td>
                                        </tr>
                                        <?php
                                        } else {
                                        while($row=mysqli_fetch_array($query))
                                        {
                                        ?>
                                        <tr>
                                            
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td><?php echo ($row['email'])?></td>
                                            <td><?php echo ($row['role'])?></td>
                                            <td class="text-nowrap">
                                                <button type="button" class="btn btn-info btn-sm preview" data-toggle="modal" data-target="#EditModal" data-id="<?php echo $row['id']; ?>" onclick="openEditModal(<?php echo htmlentities($row['id']); ?>) ">
                                                 <i class="fa fa-edit"></i></button>
                                                
                                                <button class="btn btn-danger btn-sm deleteuser" data-id="<?php echo $row['id']; ?> "><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php } }?>
                                            
                                    </tbody>
                                </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- #/ container -->
    </div>
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
        
        
        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              
                <form id="edituserdata">
                    <div class="modal-body editmodal">
                 
                    </div>
                    <div class="modal-footer">
                        <span id="success" style="color:green;"></span>
                        <span id="error" style="color:red;"></span>
                        <button type="submit" class="btn btn-primary btn-sm add">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
        <!--**********************************
        Main wrapper end
        ***********************************-->
        <!--**********************************
        Scripts
        ***********************************-->
        
        <?php include("script.php"); ?>
    </body>
</html>
<?php } ?>
<script>
$('#edituserdata').submit(function(e){
$(".add").attr("disabled", true);
e.preventDefault()
 $.ajax({
url:'ajax.php?action=edituserdata',
 data: new FormData($(this)[0]),
 cache: false,
 contentType: false,
 processData: false,
 method: 'POST',
 type: 'POST',
 error:err=>{
 console.log(err)
 },
 success:function(resp){
 if(resp == 1){
 $("#success").text("User Added Successfully");
 location.href='manage_user.php';
 }
  else if (resp == 2) {
    $("#error").text("Username or Email Already Exist");
    $(".add").attr("disabled", false);
    setTimeout(function() {
        $("#error").text('');
         }, 4000);

      }
 }
})
})
$(".deleteuser").click(function(){
      var id=$(this).attr('data-id');
       if(confirm("Are you sure you want to deleted user?")){

        $.ajax({
            url:'ajax.php?action=deleteuser',
            method:'POST',
            data:{id:id},
            success:function(resp){
                if(resp==1){
                    alert("Data Deleted Successfully!")
                    setTimeout(function(){
                        location.reload()
                    },1000)

                }
            }
        })

       }
        
     })
$(document).ready(function(){
       
       $(".preview").on("click",function(){
           var id = $(this).attr('data-id');
           
          $.ajax({
              type:'post',
              url:'ajax.php?action=edituser',
              data:{id:id},
              success:function(data){ 
                  $('.editmodal').html(data);
                 
              }
          });
           }); 
       });    
     
$(document).ready(function() {
$('#example1').DataTable(); 
});

</script>