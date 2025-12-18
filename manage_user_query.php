<?php session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
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
            <?php include("header.php"); ?>
            <?php include("sidebar.php"); ?>

            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="m-0">User Query</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active">User Query</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <section class="content pb-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <!--<div class="dropdown mb-3">-->
                                <!--      <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                <!--        Add Student-->
                                <!--      </button>-->
                                <!--      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
                                <!--        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Manual Entry</a>-->
                                <!--        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Csv File Upload</a>-->
                                <!--      </div>-->
                                <!--</div>-->
                                <div class="form-validation">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!---Success Message--->
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <strong>List Updated!</strong>
                                                </div>
                                            <?php } ?>
                                            <!---Error Message--->
                                            <?php if ($error) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-new">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Company</th>
                                                    <th>Case Type</th>
                                                    <th>Query</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqlq = "select * from user_query order by id desc";

                                                $query = mysqli_query($con, $sqlq);
                                                $cnt = 1;
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo date("d-m-Y h:s:i A", strtotime($row['created_date'])) ?></td>
                                                        <td><?php echo ucfirst($row['name']); ?></td>
                                                        <td><?php echo $row['email'] ?></td>
                                                        <td><?php echo $row['contact']; ?></td>
                                                        <td><?php echo $row['company']; ?></td>
                                                        <td><?php echo $row['case_type']; ?></td>
                                                        <td><?php echo $row['query']; ?></td>
                                                        <td><button class="btn btn-danger btn-sm deleteunsubscribe" title="Delete" data-id="<?php echo $row['id']; ?> "><i class="typcn typcn-trash"></i></button></td>

                                                    </tr>
                                                <?php $i++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- #/ container -->

            </div>

            <!--*********************************
            Content body end
        ***********************************-->






            <?php include("footer.php"); ?>

        </div>
        <?php include("script.php"); ?>

        <!--**********************************
    Main wrapper end
***********************************-->


        <!-- Page specific script -->
        <script>
            //   $('#example1').DataTable();
            $(document).ready(function() {

                $('#example1').DataTable({
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All']
                    ],
                    buttons: [{
                            extend: 'copy',
                            filename: 'User Query',
                        },
                        {
                            extend: 'csv',
                            filename: 'User Query',
                        },
                        {
                            extend: 'excel',
                            filename: 'User Query',
                        },
                        {
                            extend: 'pdf',
                            filename: 'User Query',
                        },
                        {
                            extend: 'print',
                            filename: 'User Query',
                        }
                    ]
                });
            });
        </script>
    </body>

    </html>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script>
        $(document).on("click", ".deleteunsubscribe", function() {
            var id = $(this).attr('data-id');
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: 'ajax.php?action=deleteuserquery',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        if (resp == 1) {
                            alert("Data Deleted Successfully!")
                            setTimeout(function() {
                                location.reload()
                            }, 1000)

                        }
                    }
                })
            }
        })
        $('#addlistmember').submit(function(e) {
            $(".add").attr("disabled", true);
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var list_name = $('#list_name').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var phone_number = $('#phone_number').val();
            var degination = $('#degination').val();

            if (list_name == '') {
                $(".add").attr("disabled", false);
                $("#list_name").css("border", "1px solid red");
                $("#error_list_name").text("Please Enter College name");

                return false;
            } else {
                $("#error_list_name").text("");
            }
            if (name == '') {
                $(".add").attr("disabled", false);
                $("#name").css("border", "1px solid red");
                $("#error_name").text("Please Enter Student Name");
                return false;
            } else {
                $("#error_name").text("");
            }

            if (email == '') {
                $(".add").attr("disabled", false);
                $("#email").css("border", "1px solid red");
                $("#error_email").text("Please Enter student Email Address.");

            } else if (!emailReg.test(email)) {
                $("#email").css("border", "1px solid red");
                $("#error_email").text("Enter a valid email address.");
                $(".add").attr("disabled", false);
                return false;
            } else {
                $("#email").css("border", "1px solid #2AA3D8");
                $("#error_email").text("");
            }
            if (phone_number == '') {
                $("#phone_number").css("border", "1px solid red");
                $("#error_phone_number").text("Please Enter Student Phone Number");
                return false;
            } else if (phone_number.length < 10) {
                $("#phone_number").css("border", "1px solid red");
                $("#error_phone_number").text("Contact number contains atleast 10 digit");
                return false;
            } else {
                $("#error_phone_number").text("");
            }
            if (degination == '') {
                $(".add").attr("disabled", false);
                $("#degination").css("border", "1px solid red");
                $("#error_degination").text("Please Enter Student Department")
                return false;
                $(".add").attr("disabled", false);
            } else {
                $("#error_degination").text("");
            }
            e.preventDefault()
            $.ajax({
                url: 'ajax.php?action=addlistmember',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                error: err => {
                    console.log(err)
                },
                success: function(resp) {
                    if (resp == 1) {
                        $("#sucess").text('Student Successfully Added.');
                        location.reload();
                    }
                }
            })
        })

        $('#editlistmember').submit(function(e) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

            var name = $('#name1').val();
            var email = $('#email1').val();
            var phone_number = $('#phone_number1').val();
            var degination = $('#degination1').val();


            if (name == '') {
                $(".add").attr("disabled", false);
                $("#name1").css("border", "1px solid red");
                $("#error_name1").text("Please Enter Student Name");
                return false;
            } else {
                $("#error_name1").text("");
                $("#name1").css("border", "1px solid #2AA3D8");
            }

            if (email == '') {
                $(".add").attr("disabled", false);
                $("#email1").css("border", "1px solid red");
                $("#error_email1").text("Please Enter student Email Address.");

            } else if (!emailReg.test(email)) {
                $("#email1").css("border", "1px solid red");
                $("#error_email1").text("Enter a valid email address.");
                $(".add").attr("disabled", false);
                return false;
            } else {
                $("#email1").css("border", "1px solid #2AA3D8");
                $("#error_email1").text("");
            }
            if (phone_number == '') {
                $("#phone_number1").css("border", "1px solid red");
                $("#error_phone_number1").text("Please Enter Student Phone Number");
                return false;
            } else if (phone_number.length < 10) {
                $("#phone_number1").css("border", "1px solid red");
                $("#error_phone_number1").text("Contact number contains atleast 10 digit");
                return false;
            } else {
                $("#error_phone_number1").text("");
                $("#phone_number1").css("border", "1px solid #2AA3D8");
            }
            if (degination == '') {
                $(".add").attr("disabled", false);
                $("#degination1").css("border", "1px solid red");
                $("#error_degination1").text("Please Enter Student Department")
                return false;
                $(".add").attr("disabled", false);
            } else {
                $("#error_degination1").text("");
                $("#degination1").css("border", "1px solid #2AA3D8");
            }
            e.preventDefault()
            $.ajax({
                url: 'ajax.php?action=addlistmember',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                error: err => {
                    console.log(err)
                },
                success: function(resp) {
                    if (resp == 2) {
                        $("#sucess1").text('Student Successfully Updated.');
                        location.reload();
                    }
                }
            })
        })

        $(document).on("click", ".preview", function() {
            var id = $(this).attr('data-id');
            $('.editlistdata').html("");
            $.ajax({
                type: 'post',
                url: 'ajax.php?action=editmember',
                data: {
                    id: id
                },
                success: function(data) {
                    $('.editlistdata').html(data);

                }
            });
        });
    </script>
<?php } ?>