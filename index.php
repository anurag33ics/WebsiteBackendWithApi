<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
if(isset($_POST['login']))
  {
    // Getting username/ email and password
     $uname=$_POST['username'];
     $password=$_POST['password'];
    // echo "SELECT AdminUserName,AdminEmailId,AdminPassword FROM tbladmin WHERE (AdminUserName='$uname' || AdminEmailId='$uname')";die;
    // Fetch data from database on the basis of username/email and password
$sql =mysqli_query($con,"SELECT id,name,username,password,role FROM admin_table WHERE (username ='$uname' )");
 $num=mysqli_fetch_array($sql);
 //print_r($num);
if($num>0)
{
$hashpassword=$num['password']; // Hashed password fething from database
//verifying Password
if ($password==$hashpassword) {
     
     $_SESSION['abc'] ='s';
     $_SESSION['login'] = $uname;
     $_SESSION['login_id'] = $num['id'];
     $_SESSION['role'] = $num['role'];
    echo"<script>window.location.href='dashboard.php';</script>";
    //echo ""
    //header("Location:../admin/dashboard.php");
  } else {
echo "<script>alert('Wrong Password');</script>";
  }
}//if username or email not found in database
else{
echo "<script>alert('User not registered with us');</script>";
  }
}
?>
<?php include("head.php") ?>

<style>
.login-form-bg,
.login-form {
    height: 100vh;
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-formin {
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    box-shadow: 0 0 10px #ccc;
    border-radius: 20px;
    height: 100%;
    max-height: 420px;
}

.login-formin .lft-box {
    overflow: hidden;
    display: flex;
    height: 100%;
    padding: 15px;
}
.login-formin .login-logo {
        display: block;
    width: 100%;
    max-width: 230px;
    position: relative;
    z-index: 2;
    height: max-content;
    background: rgba(255,255,255,.8);
}

.login-formin a.login-logo img {
    width: 100%;
}


.login-formin .row {
    height: 100%;
}

.login-formin .lft-box .coverimg {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    border-radius: 20px  0 0 20px;
    overflow: hidden;
    display: block;
}

.login-formin .lft-box .coverimg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}


.login-formin .rgt-box {
    padding: 40px 50px;
}

.login-formin .rgt-box h3{
    font-weight: 800;
    text-transform: uppercase;
}

.login-formin .login-tbs {
    display: table;
    width: 100%;
    margin: 10px 0 20px;
}

.login-formin .login-tbs > a {
    display: block;
    color: #000;
    width: 50%;
    float: left;
    text-align: center;
    padding: 10px;
    text-transform: capitalize;
    border-bottom: solid 2px transparent;
}

.login-formin .login-tbs > a.active,
.login-formin .login-tbs > a:hover {border-bottom-color: #03045e;color: #03045e;}


@media (max-width:767px){
    .login-form {height: auto;}
    .login-formin .lft-box{margin: 0 8px 0 7px; height: 250px;}
    .login-formin .lft-box .coverimg{border-radius: 20px 20px 0 0;}
    .login-formin .login-logo{margin: 0 auto;}
    
    .login-formin{max-height: inherit;}
    .login-formin .rgt-box {padding: 40px 30px;}
    .login-formin .rgt-box h3{text-align:center;}
}

</style>

</head>

<body class="h-100" style="background-image: url(images/login-bg.jpg)">
    <?php include("loader.php"); ?>  
    
    <div class="login-form">
        <div class="login-formin">
            <div class="row">
                <div class="col-md-6 lft-box">
                    <!-- <a href="#" class="login-logo">
                        <img src="../img/newlogo.png">
                    </a> -->
                    <div class="coverimg">
                        <img src="images/logo/logo.png">
                    </div>
                </div>
                <div class="col-md-6 rgt-box">
                    <h3>Login</h3><br>
                    <!--<div class="login-tbs">-->
                    <!--    <a href="https://www.bugendaitech.com/admin2/index.php" class="active">Admin Login</a>-->
                    <!--    <a href="https://www.bugendaitech.com/blog_admin" class="">Blog Login</a>-->
                    <!--</div>-->
                    <form class="login-input" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username or email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" required="" placeholder="Password" autocomplete="off">
                        </div>
                        <button class="btn btn-primary login-form__btn submit w-100" id='login' type="submit" name="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

<!--**********************************
    Scripts
***********************************-->
<?php include("script.php"); ?>
</body>
</html>





