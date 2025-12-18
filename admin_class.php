<?php
session_start();
ini_set('display_errors', 1);
// require_once 'vendor/autoload.php'; 
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
Class Action {
private $db;
public function __construct() {
ob_start();
include 'includes/config.php';
include 'includes/SimpleXLSX.php';


$this->db = $con;
}
function __destruct() {
$this->db->close();
ob_end_flush();
}
function login(){
extract($_POST);
$qry = $this->db->query("SELECT * FROM admin where username = '".$username."' and password = '".$password."' ");
if($qry->num_rows > 0){
foreach ($qry->fetch_array() as $key => $value) {
if($key != 'passwords' && !is_numeric($key))
{
$_SESSION['login_'.$key] = $value;
}


}
return 1;
}else{
return 3;
}
}
function logout(){
session_destroy();
foreach ($_SESSION as $key => $value) {
unset($_SESSION[$key]);
}
header("location:login.php");
}


// added new
function  deletemember()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM admission where id = ".$id);
if($delete)
return 1;
}

function  deleteFeedback()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM feedback where id = ".$id);
if($delete)
return 1;
}
function  deleteAlumni()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM alumni_regis where id = ".$id);
if($delete)
return 1;
}

function  deleteFaculty()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM faculty where id = ".$id);
if($delete)
return 1;
}

function  addFaculty()
{
extract($_POST);

$n_faculty=$this->db->real_escape_string($_POST['name']);
$n_quali=$this->db->real_escape_string($_POST['qualification']);
$n_depart=$this->db->real_escape_string($_POST['department']);
$n_designation=$this->db->real_escape_string($_POST['designation']);
$n_contact=$this->db->real_escape_string($_POST['phone_number']);
$today1 = date("y-m-d");    
//$display=test_input1($_POST['display']);

$rowid= $this->db->real_escape_string($_POST['rowid']);

if($rowid==0)
$sql="insert into faculty(faculty,qualification,department,contact,designation) values('$n_faculty','$n_quali','$n_depart','$n_contact','$n_designation')";
else
$sql= "UPDATE faculty SET faculty ='$n_faculty', qualification='$n_quali', department='$n_depart',contact='$n_contact',designation='$n_designation' WHERE id ='$rowid'  ";



$insert = $this->db->query($sql);
if($insert)
return 1;
}

function  deleteTC()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM tc where id = ".$id);
if($delete)
return 1;
}

function  addTC()
{
extract($_POST);

if (0 < $_FILES['file2']['error']) {
            return 'Error: ' . $_FILES['file2']['error'] . '<br>';
        } else {
            $file = $_FILES['file2']['name'];
    move_uploaded_file($_FILES['file2']['tmp_name'], "../../web-login/tc/" . $file);
            
$fname=  $_FILES['file2']['name'];
$sname=$this->db->real_escape_string($_POST['sname']);
$tcnumber=$this->db->real_escape_string($_POST['tcnumber']);
$insql="insert into tc(sname,tcnumber,path) values('$sname','$tcnumber','$fname')";
$ins =$this->db->query($insql);
return 1;
}
}


function  addNews()
{
extract($_POST);

// if (0 < $_FILES['file2']['error']) {
//             return 'Error: ' . $_FILES['file2']['error'] . '<br>';
//         } else {
            $fname='';
            if( $_FILES['file2']['name']!=''){
            $file = $_FILES['file2']['name'];
    move_uploaded_file($_FILES['file2']['tmp_name'], "../../web-login/news_image/" . $file);
            
$fname=  $_FILES['file2']['name'];
}
$n_title=$this->db->real_escape_string($_POST['title']);
$n_short=$this->db->real_escape_string($_POST['desc']);
$n_long=$this->db->real_escape_string($_POST['longdesc']);
$today1 = date("Y-m-d");  

if($rowid==0){
$insql="insert into bvm_news(title,short_des,long_des,date,image) values('$n_title','$n_short','$n_long','$today1','$fname')";
}else{
    if($fname=='')
    $insql="update bvm_news set title='$n_title', short_des='$n_short',long_des='$n_long' where id='$rowid'";
    else
    $insql="update bvm_news set title='$n_title', short_des='$n_short',long_des='$n_long', image='$fname' where id='$rowid'";

    
}


$ins =$this->db->query($insql);
return 1;

}
function  deleteNews()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM bvm_news where id = ".$id);
if($delete)
return 1;
}

function  deleteEvent()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM athena_news where n_id = ".$id);
if($delete)
return 1;
}
function  addEvent()
{
extract($_POST);
$n_title=$this->db->real_escape_string($_POST['title']);
$n_short=$this->db->real_escape_string($_POST['desc']);
$n_date=$this->db->real_escape_string($_POST['edate']);

if($rowid==0)
$insql="insert into athena_news(n_title,n_description,n_date) values('$n_title','$n_short','$n_date')";
else
$insql="update athena_news set n_date='$n_date',n_title='$n_title',n_description='$n_short' where n_id='$rowid'";

$res = $this->db->query($insql);
if($res)
return 1;
}
function addNotice()
{
extract($_POST);

// if (0 < $_FILES['file2']['error']) {
//             return 'Error: ' . $_FILES['file2']['error'] . '<br>';
//         } else {
            $fname='';
            if( $_FILES['file2']['name']!=''){
            $file = $_FILES['file2']['name'];
    move_uploaded_file($_FILES['file2']['tmp_name'], "../../web-login/notice/" . $file);
            
$fname=  $_FILES['file2']['name'];
}
$n_title=$this->db->real_escape_string(trim($_POST['title']));
$today1 = date("Y-m-d");  

if($rowid==0){
$insql="insert into cnotice(title,path) values('$n_title','../notice/$fname')";
}else{
    if($fname=='')
    $insql="update bvm_news set title='$n_title', short_des='$n_short',long_des='$n_long' where id='$rowid'";
    else
    $insql="update bvm_news set title='$n_title', short_des='$n_short',long_des='$n_long', image='$fname' where id='$rowid'";

    
}


$ins =$this->db->query($insql);
return 1;

}

function  deleteNotice()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM cnotice where id = ".$id);
if($delete)
return 1;
}

function  addLightboxImage()
{
    extract($_POST);
            $fname='';
            if( $_FILES['file2']['name']!=''){
            $file = $_FILES['file2']['name'];
    move_uploaded_file($_FILES['file2']['tmp_name'], "../../web-login/lightboximage/" . $file);
            
$fname=  $_FILES['file2']['name'];
}
// $n_title=$this->db->real_escape_string(trim($_POST['title']));
$today1 = date("Y-m-d");  

if($rowid==0){
$insql="insert into lightboximage(visible, imagepath) values('True','../lightboximage/$fname')";
}

$ins =$this->db->query($insql);
return 1;
    
}

function  addadd_faulty_image()
{
    extract($_POST);
            $fname='';
            if( $_FILES['file2']['name']!=''){
            $file = $_FILES['file2']['name'];
    move_uploaded_file($_FILES['file2']['tmp_name'], "../../web-login/facultyImage/" . $file);
            
$fname=  $_FILES['file2']['name'];
}
// $n_title=$this->db->real_escape_string(trim($_POST['title']));
$today1 = date("Y-m-d");  

if($rowid==0){
$insql="insert into add_faulty_image(visible, imagepath) values('True','../facultyImage/$fname')";
}

$ins =$this->db->query($insql);
return 1;
    
}


function  deleteLightboxImage()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM lightboximage where id = ".$id);
if($delete)
return 1;
}

function  deleteAlbum()
{
extract($_POST);
$sqldel="select * from simage where albumid=$id";
            $exedel=$this->db->query($sqldel);
            
            while($records=mysqli_fetch_array($exedel))
              {
                            if(substr($records['path'],0,3)=="../")
              $path= substr($records['path'], 3);
               else 
                 $path= $records['path']; 
               unlink("../../web-login/".$path);
             }
            $delsql="delete from simage where albumid=$id";
          $exedsql=$this->db->query($delsql);
          $delsql="delete from multi where id=$id";
          $delete=$this->db->query($delsql);
        
if($delete)
return 1;
}

function  addAlbum()
{
extract($_POST);

 $album=$_POST['title'];
     
     $sql_insert="insert into multi(album) values('$album')";
     $res=$this->db->query($sql_insert);
     $gen_id= $this->db->insert_id;
    $msg="";

  // Loop $_FILES to exeicute all files
   
    
  foreach ($_FILES['files']['name'] as $f => $name) {     
    ///
    $sql_insert1="insert into simage(albumid) values('$gen_id')";
               $fname='';
            if( $_FILES['files']['name']!=''){
            $file = $_FILES['files']['name'][$f];
    move_uploaded_file($_FILES['files']['tmp_name'][$f], "../../web-login/uploads/" . $file);
            
        $fname=  $_FILES['files']['name'][$f];
    }
     $sql_insert1="insert into simage(albumid,path) values('$gen_id','../uploads/$fname')";
        $res=$this->db->query($sql_insert1);
      }
      return 1;
}

function  deleteImage()
{
extract($_POST);

$sqldel="select * from simage where id=$id";
            $exedel=$this->db->query($sqldel);
            
            while($records=mysqli_fetch_array($exedel))
              {
                            if(substr($records['path'],0,3)=="../")
              $path= substr($records['path'], 3);
               else 
                 $path= $records['path']; 
               unlink("../../web-login/".$path);
             }
            $delsql="delete from simage where id=$id";
          $delete=$this->db->query($delsql);
         
        
if($delete)
return 1;
}

function  addImageToAlbum()
{
    extract($_POST);
            $fname='';
            if( $_FILES['file2']['name']!=''){
            $file = $_FILES['file2']['name'];
    move_uploaded_file($_FILES['file2']['tmp_name'], "../../web-login/uploads/" . $file);
            
$fname=  $_FILES['file2']['name'];
}
// $n_title=$this->db->real_escape_string(trim($_POST['title']));
$today1 = date("Y-m-d");  

if($rowid!=0){
 $sql_insert1="insert into simage(albumid,path) values('$rowid','../uploads/$fname')";
}

$ins =$this->db->query($sql_insert1);
return 1;
    
}


function  deleteGroup()
{
extract($_POST);

$delete = $this->db->query("DELETE FROM groupname where id = ".$id);
if($delete)
return 1;
}

function  addGroup()
{
extract($_POST);

$n_gname=$this->db->real_escape_string($_POST['gname']);
$n_grade=$this->db->real_escape_string($_POST['grade']);

if($rowid==0)
    $sql="insert into groupname(gname,classname) values('$n_gname','$n_grade')";
else
    $sql="UPDATE groupname SET  gname ='$n_gname', classname='$n_grade' WHERE id='$rowid'";
$add=  $this->db->query($sql);



if($add)
return 1;
}


function  addSubjectType()
{
extract($_POST);

$n_stypename=$this->db->real_escape_string($_POST['stypename']);


if($rowid==0)
    $sql="insert into subjecttype(name) values('$n_stypename')";
else
    $sql="UPDATE subjecttype SET  name ='$n_stypename' WHERE id='$rowid'";
$add=  $this->db->query($sql);



if($add)
return 1;
}



function  deleteRecord()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM ".$tblname." where id = ".$id);
if($delete)
return 1;
    
}

function  addSubject()
{
extract($_POST);
$n_title=$this->db->real_escape_string($_POST['sname']);
$n_classname=$this->db->real_escape_string($_POST['grade']);
$n_gid=$this->db->real_escape_string($_POST['gname']);
$n_subjectc=$this->db->real_escape_string($_POST['stype']);
 if($rowid=="0")
    $sql="insert into subjects(subject,gid,subjecttypeid,classname) value('$n_title','$n_gid','$n_subjectc','$n_classname')";
 else
 $sql="update subjects set subject='$n_title',gid='$n_gid',subjecttypeid   ='$n_subjectc',classname='$n_classname' where id='$rowid'";
    
$add = $this->db->query($sql);
if($add)
return 1;
     
}


function  addGrade()
{
extract($_POST);

$n_stypename=$this->db->real_escape_string($_POST['grade']);


if($rowid==0)
    $sql="insert into classname(name) values('$n_stypename')";
else
    $sql="UPDATE classname SET  name ='$n_stypename' WHERE id='$rowid'";
$add=  $this->db->query($sql);



if($add)
return 1;
}



function  addToppers()
{
extract($_POST);
            $fname='';
            if( $_FILES['file2']['name']!=''){
            $file = $_FILES['file2']['name'];
    move_uploaded_file($_FILES['file2']['tmp_name'], "../../web-login/toppers/" . $file);
            
$fname=  $_FILES['file2']['name'];
}
$n_name=$this->db->real_escape_string($_POST['name']);
$n_class=$this->db->real_escape_string($_POST['grade']);
$n_year=$this->db->real_escape_string($_POST['year']);


if($rowid==0){
$insql="INSERT INTO `add_toppers` (`id`, `name`, `year`, `class`, `image`, `createdDate`) VALUES (NULL, '$n_name', '$n_year', '$n_class', 'toppers/$fname', CURRENT_TIMESTAMP)";
}


$ins =$this->db->query($insql);
return 1;

}
// end here









function unsubscribe()
{
extract($_POST);
$checkBox = implode(',', $_POST['checkbox']);

$data .= "email = '$email' ";
$data .= ", reason = '$reason' ";
$data .= ", checkbox = '$checkBox' ";
$data .= ", emailtemplate = '$emailtemplate' ";
$data .= ", campaign_name= '$campaign_name' ";
$data .= ", list_id= '$list_id' ";

$save = $this->db->query("insert unsubscribe set ".$data."");
$save1 = $this->db->query("UPDATE addmember set status='Unsubscribe' where list_id='$list_id' and email='$email'");
return 1;

}
function  deleteunsubscribe()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM unsubscribe where id = ".$id);
if($delete)
return 1;
}


function adduser()
{
extract($_POST);


$query = $this->db->query("SELECT * from admin where name ='$name' or email='$email'");
$rowcount = mysqli_num_rows($query);
if($rowcount>0){
    return 2;
}

else{
$pass=$_POST['password'];
$id=$_POST['id'];
$data = "name = '$name' ";
$data .= ", email = '$email' ";
$data .= ", password = '$pass' ";
$data .= ", role = '$role' ";

if(empty($id)){
			$save = $this->db->query("INSERT INTO admin set ".$data);
			return 1;
		}  else{
		    
			$save = $this->db->query("UPDATE admin set ".$data." where id = ".$id);
		    return 2;
		}
}
}
function edituserdata()
{
extract($_POST);


$query = $this->db->query("SELECT * from admin where name ='$name' or email='$email'");
$rowcount = mysqli_num_rows($query);
if($rowcount>0){
    return 2;
}

else{
$pass=$_POST['password'];
$id=$_POST['id'];
$data = "name = '$name' ";
$data .= ", email = '$email' ";
$data .= ", password = '$pass' ";
$data .= ", role = '$role' ";

	$save = $this->db->query("UPDATE admin set ".$data." where id = ".$id);
    return 1;
		}
}
function  deleteuser()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM admin where id = ".$id);
if($delete)
return 1;
}
function  deleteuserquery()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM user_query where id = ".$id);
if($delete)
return 1;
}



function edituser(){
    
    extract($_POST);
    $id=$_POST['id'];
    $query = $this->db->query("SELECT * from admin where id='$id'")->fetch_array();
    $id=$query['id'];
    $name=$query['name'];
    $email=$query['email'];
    $role=$query['role'];
    echo "<div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Name</b></label>
            <input type='hidden' class='form-control' id='id' value='$id' name='id' required>
            <input type='text' class='form-control' id='name' value='$name' name='name' required>
            </div>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Email</b></label>
            <input type='text' class='form-control' id='name' value='$email' name='email' required>
            </div>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>password</b></label>
            <input type='password' class='form-control' id='name' value='12345678' name='password' required>
            </div>
            <br>
            <div class='form-group'>
            <label for=recipient-name' class=col-form-label>Role Type</label>
            <select class='form-control' name='role' required>
            <option selected >Select Role Type</option>
            <option value='admin' $role == 'admin' ? ' selected='selected' : '';>Admin</option>
            <option value='manager'$role == 'manager' ? ' selected='selected' : '';>Manager</option>
            </select>
            </div>";
    
}
function addcollege()
{
extract($_POST);


$id1=$_POST['id'];

$query = $this->db->query("SELECT * from  college_list where college_name ='$college_name'");
$rowcount = mysqli_num_rows($query);
if($rowcount>0){
    return 3;
}

else{
$id=$_SESSION['login_id'];
$data .= "  college_name = '$college_name' ";
$data .= ", college_email = '$college_email' ";
$data .= ", college_phoneno  = '$college_phoneno    ' ";
$data .= ", college_location = '$college_location' ";
$data .= ", session_id = '$id' ";

if(empty($id1)){
            $save = $this->db->query("INSERT INTO college_list set ".$data);
            return 1;
        }
}
}
function editcollege()
{
extract($_POST);


$id1=$_POST['id'];


$id=$_SESSION['login_id'];
$data .= "  college_name = '$college_name' ";
$data .= ", college_email = '$college_email' ";
$data .= ", college_phoneno  = '$college_phoneno    ' ";
$data .= ", college_location = '$college_location' ";
$data .= ", session_id = '$id' ";


            $save = $this->db->query("UPDATE college_list set ".$data." where id = ".$id1);
            return 2;
        
}
function addlistmember()
{
extract($_POST);
$id=$_SESSION['login_id'];
$member_id=$_POST['id'];
$data .= "name = '$name' ";
$data .= ", collegelist_id = '$college_name' ";
$data .= ", session_id = '$id' ";
$data .= ", email = '$email' ";
$data .= ", phone_no = '$phone_no' ";
$data .= ", department = '$department'";
$data .= ", type = '$type'";
if (isset($_FILES["post_image"]) && $_FILES["post_image"]['name']!== "")
{
$status = false;
$target_dir = "images/";
$file=$_FILES["post_image"]['name'];
$target_file = $target_dir . basename($file);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$extallowed = array(
"pdf",
);
if (!in_array(strtolower($imageFileType) , $extallowed))
{
$status = false;
$uploadOk = 0;
}
$filename = uniqid() .'.'. $imageFileType;
$filepath = $target_dir . $filename;
}
if ($file > 10000000000000)
{
$status = false;
$uploadOk = 0;
}
if (!move_uploaded_file($_FILES["post_image"]["tmp_name"], $filepath))
{
$uploadOk = 0;
}
else
{
$file_name = $filename;
}
$data .= ",resume= '$filename'";
$data .= ",address = '$address'";
if(empty($member_id)){
    
            $save = $this->db->query("INSERT INTO addstudent set ".$data);
            return 1;
        }else{
            
            $save = $this->db->query("UPDATE addstudent set ".$data." where id = ".$member_id);
            return 2;
        }
}


function  deletelist()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM college_list where id = ".$id);
if($delete)
return 1;
}
function editlist(){
    
     extract($_POST);
    $id=$_POST['id'];
    
   $query = $this->db->query("SELECT * from college_list where id='$id'")->fetch_array();
    $id=$query['id'];
    $cname=$query['college_name'];
    $cemail=$query['college_email'];
    $cphone=$query['college_phoneno'];
    $clocation=$query['college_location'];
    echo "<div class='form-group>
            <label for=recipient-name' class=col-form-label><b>College Name</b></label>
            <input type='hidden' class='form-control' id='name' value='$id' name='id' required>
            <input type='text' class='form-control' id='college_name' value='$cname' name='college_name'>
            </div>
             <span id='error_college_name' style='color:red'></span>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>College Email</b></label>
            <input type='text' class='form-control' id='college_email' value='$cemail' name='college_email'>
            </div>
            <span id='error_college_email' style='color:red'></span>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>College Phone</b></label>
            <input type='text' class='form-control' id='college_phoneno' value='$cphone' name='college_phoneno' >
            </div>
             <span id='error_college_phoneno' style='color:red'></span>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Address</b></label>
            <input type='text' class='form-control' id='college_location' value='$clocation' name='college_location' >
            </div>
            <span id='error_college_location' style='color:red'></span>
            ";
    
    
    
}


function editmember(){
    
    extract($_POST);
    $id=$_POST['id'];
    
    $query = $this->db->query("SELECT * from addstudent where id='$id'")->fetch_array();
    $id=$query['id'];
    $list_id=$query['collegelist_id'];
    $name=$query['name'];
    $email=$query['email'];
    $phone=$query['phone_no'];
    $degination=$query['department'];
    $address=$query['address'];
    
     echo " 
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Name</b></label>
            <input type='hidden' class='form-control' id='name' value='$list_id' name='college_name' required>
            <input type='hidden' class='form-control' id='name' value='$id' name='id' required>
            <input type='text' class='form-control' id='name1' value='$name' name='name' required>
            </div>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Email</b></label>
            <input type='text' class='form-control' id='email1' value='$email' name='email' >
            </div>
            <span id='error_email1' style='color:red'></span>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Phone Number</b></label>
            <input type='number' class='form-control' id='phone_number1' value='$phone' name='phone_no'>
            </div>
             <span id='error_phone_number1' style='color:red;'></span>
            <br>
            <div class='form-group'>
            <label for='recipient-name' class='col-form-label'>Department</label>
            <input type='text' class='form-control' id='degination1' value='$degination' name='department'>
             </div>
             <span id='error_degination1' style='color:red;'></span>
            <div class='form-group'>
            <label for='recipient-name' class='col-form-label'>Address</label>
            <input type='text' class='form-control' id='recipient-name' value='$address' name='address'>
             </div>
            ";
    
    
}



function addcsvfile()
{
extract($_POST);
$id=$_SESSION['login_id'];


if ( $xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'] ) )

     {

$i=1;
$count=0;
foreach ( $xlsx->rows() as $k => $r )
 {   
  
  if($i!=1){
      if($r==""){
          $count=+1;
      }
      else{
          
          if($r[0]!="" && $r[1]!="" && $r[2]!="" && $r[3]!=""  && $r[4]!="" ){
              
              $save = $this->db->query("INSERT INTO addstudent set name='$r[0]',
            email='$r[1]',phone_no='$r[2]',department='$r[3]',address='$r[4]',session_id='$id',collegelist_id='$college_name',type='$type'");
          }
          
      }
       } 
  $i++;
}
if($count==0){
   if($save)
 return 1;

} 
}
 else{
        return 2;
    }
}

function changepass()
{
extract($_POST);
$data='';
$id=$_SESSION['login_id'];
$query = $this->db->query("SELECT * from  admin_table where password ='$password' and id='$id'")->fetch_array();
if($query ==''){
    return 3;
}else{
   $data .= " password = '$newpassword' ";
	$save = $this->db->query("UPDATE admin_table set ".$data." where id = ".$id);
    return 1;
}
}


function changeprofiles()
{
extract($_POST);
$id=$_SESSION['login_id'];
$data = " name= '$name'";
$data .= ", email= '$email'";

if (isset($_FILES["post_image"]) && $_FILES["post_image"]['name']!== "")
{
$status = false;
$target_dir = "images/profile/";
$file=$_FILES["post_image"]['name'];
$target_file = $target_dir . basename($file);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$extallowed = array(
"jpg",
"jpeg",
"png",
);
if (!in_array(strtolower($imageFileType) , $extallowed))
{
$status = false;
$uploadOk = 0;
}
$filename = uniqid() .'.'. $imageFileType;
$filepath = $target_dir . $filename;
}
if ($file > 10000000000000)
{
$status = false;
$uploadOk = 0;
}
if (!move_uploaded_file($_FILES["post_image"]["tmp_name"], $filepath))
{
$uploadOk = 0;
}
else
{
$file_name = $filename;
}
$data .= ",image= '$filename'";
if ($_FILES["post_image"]['name']!==""){
    //echo "update admin set $data where id = '$id'";
    $query = $this->db->query("update admin_table set $data where id = '$id'");
    if($query)
return 1;
}
else{
    //echo "update admin set name='$name', email='$email' where id = '$id'";
$query = $this->db->query("update admin_table set name='$name', email='$email' where id = '$id'");
if($query)
return 1;
}
}


function addpoc()
{
extract($_POST);
$id=$_SESSION['login_id'];
$member_id=$_POST['id'];
$data .= "name = '$name' ";
$data .= ", collegelist_id = '$college_name' ";
$data .= ", session_id = '$id' ";
$data .= ", email = '$email' ";
$data .= ", phone_no = '$phone_no' ";
$data .= ", degination = '$degination'";
$data .= ", website = '$website' ";
$data .= ", address = '$address'";

if(empty($member_id)){
    
            $save = $this->db->query("INSERT INTO addpoc set ".$data);
            return 1;
        }else{
            
            $save = $this->db->query("UPDATE addpoc set ".$data." where id = ".$member_id);
            return 2;
        }
}

function  deletepoc()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM addpoc where id = ".$id);
if($delete)
return 1;
}

function editpoc(){
    
    extract($_POST);
    $id=$_POST['id'];
    
    $query = $this->db->query("SELECT * from addpoc where id='$id'")->fetch_array();
    $id=$query['id'];
    $list_id=$query['collegelist_id'];
    $name=$query['name'];
    $email=$query['email'];
    $phone=$query['phone_no'];
    $degination=$query['degination'];
    $website=$query['website'];
    $address=$query['address'];
    
    echo "<div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Name</b></label>
            <input type='hidden' class='form-control' id='name' value='$list_id' name='college_name' required>
            <input type='hidden' class='form-control' id='name' value='$id' name='id' required>
            <input type='text' class='form-control' id='name' value='$name' name='name'>
            </div>
            <span id='error_name' style='color:red'></span>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Email</b></label>
            <input type='text' class='form-control' id='email' value='$email' name='email'>
            </div>
            <span id='error_email' style='color:red'></span>
            <br>
            <div class='form-group>
            <label for=recipient-name' class=col-form-label><b>Phone Number</b></label>
            <input type='number' class='form-control' id='phone_number' value='$phone' name='phone_no'>
            </div>
            <span id='error_phone_number' style='color:red'></span>
            <br>
            <div class='form-group'>
            <label for='recipient-name' class='col-form-label'>Department</label>
            <input type='text' class='form-control' id='recipient-name' value='$degination' name='degination'>
             </div>
             <span id='error_college_name' style='color:red'></span>
             <br>
            <div class='form-group'>
            <label for='recipient-name' class='col-form-label'>Department</label>
            <input type='text' class='form-control' id='recipient-name' value='$website' name='website' >
             </div>
             <br>
            <div class='form-group'>
            <label for='recipient-name' class='col-form-label'>Address</label>
            <input type='text' class='form-control' id='recipient-name' value='$address' name='address' >
             </div>
            ";
    
    
}
function resume_upload()
    {
        $sessionid = $_SESSION['login_id'];
        $id = $_POST['id'];
        if (0 < $_FILES['file']['error']) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            $file = $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], 'images/' . $_FILES['file']['name']);


            $save = $this->db->query("update addstudent set resume='$file', session_id='$sessionid' where id = '$id'");

            if ($save)
                return 1;
            else
                return 0;
        }
    }
function addbanner()
{
extract($_POST);
$id=$_SESSION['login_id'];
$data = " session_id= '$id'";
$data .= ", heading = '$title'";
$data .= ", decription= '$desc'";

if (isset($_FILES["post_image"]) && $_FILES["post_image"]['name']!== "")
{
$status = false;
$target_dir = "images/";
$file=$_FILES["post_image"]['name'];
$target_file = $target_dir . basename($file);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$extallowed = array(
"jpg",
"jpeg",
"png",
);
if (!in_array(strtolower($imageFileType) , $extallowed))
{
$status = false;
$uploadOk = 0;
}
$filename = uniqid() .'.'. $imageFileType;
$filepath = $target_dir . $filename;
}
if ($file > 10000000000000)
{
$status = false;
$uploadOk = 0;
}
if (!move_uploaded_file($_FILES["post_image"]["tmp_name"], $filepath))
{
$uploadOk = 0;
}
else
{
$file_name = $filename;
}
$data .= ",post_image= '$filename'";

$query = $this->db->query("insert into banner set $data");
if($query)
return 1;
}

function editbanner()
{
extract($_POST);
$sid=$_SESSION['login_id'];
$data = " session_id= '$sid'";
$data .= ", heading = '$title'";
$data .= ", decription= '$desc'";
if (isset($_FILES["post_image"]) && $_FILES["post_image"]['name']!== "")
{
$status = false;
$target_dir = "images/";
$file=$_FILES["post_image"]['name'];
$target_file = $target_dir . basename($file);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$extallowed = array(
"jpg",
"jpeg",
"png",
);
if (!in_array(strtolower($imageFileType) , $extallowed))
{
$status = false;
$uploadOk = 0;
}
$filename = uniqid() .'.'. $imageFileType;
$filepath = $target_dir . $filename;
}
if ($file > 10000000000000)
{
$status = false;
$uploadOk = 0;
}
if (!move_uploaded_file($_FILES["post_image"]["tmp_name"], $filepath))
{
$uploadOk = 0;
}
else
{
$file_name = $filename;
}
$data .= ", post_image= '$file_name'";
if ($_FILES["post_image"]['name']!==""){
    //echo "update banner set $data where id = '$id'";
    $query = $this->db->query("update banner set $data where id = '$id'");
    if($query)
return 1;
}
else{
    //echo "update banner set heading='$title', decription='$desc' where id = '$id'";
$query = $this->db->query("update banner set heading='$title', decription='$desc' where id = '$id'");
if($query)
return 1;
}
}
function  deletebanner()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM banner where id = ".$id);
if($delete)
return 1;
}

function addcollgevisit()
{
extract($_POST);
$id=$_SESSION['login_id'];
$data = " session_id= '$id'";
$data .= ", college_name = '$college_name'";
$data .= ", college_course= '$college_course'";
$data .= ", college_title= '$college_title'";
$data .= ", visit_date= '$visit_date'";

if (isset($_FILES["post_image"]) && $_FILES["post_image"]['name']!== "")
{
$status = false;
$target_dir = "images/";
$file=$_FILES["post_image"]['name'];
$target_file = $target_dir . basename($file);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$extallowed = array(
"jpg",
"jpeg",
"png",
);
if (!in_array(strtolower($imageFileType) , $extallowed))
{
$status = false;
$uploadOk = 0;
}
$filename = uniqid() .'.'. $imageFileType;
$filepath = $target_dir . $filename;
}
if ($file > 10000000000000)
{
$status = false;
$uploadOk = 0;
}
if (!move_uploaded_file($_FILES["post_image"]["tmp_name"], $filepath))
{
$uploadOk = 0;
}
else
{
$file_name = $filename;
}
$data .= ", image= '$filename'";
// echo "insert into college_visit set $data";
$query = $this->db->query("insert into college_visit set $data");
if($query)
return 1;
}

function editcollegevisit()
{
extract($_POST);
$sid=$_SESSION['login_id'];
$data = " session_id= '$id'";
$data .= ", college_name = '$college_name'";
$data .= ", college_course= '$college_course'";
$data .= ", college_title= '$college_title'";
$data .= ", visit_date= '$visit_date'";
if (isset($_FILES["post_image"]) && $_FILES["post_image"]['name']!== "")
{
$status = false;
$target_dir = "images/";
$file=$_FILES["post_image"]['name'];
$target_file = $target_dir . basename($file);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$extallowed = array(
"jpg",
"jpeg",
"png",
);
if (!in_array(strtolower($imageFileType) , $extallowed))
{
$status = false;
$uploadOk = 0;
}
$filename = uniqid() .'.'. $imageFileType;
$filepath = $target_dir . $filename;
}
if ($file > 10000000000000)
{
$status = false;
$uploadOk = 0;
}
if (!move_uploaded_file($_FILES["post_image"]["tmp_name"], $filepath))
{
$uploadOk = 0;
}
else
{
$file_name = $filename;
}
$data .= ", image= '$file_name'";
if ($_FILES["post_image"]['name']!==""){
    //echo "update college_visit set $data where id = '$id'";
    $query = $this->db->query("update college_visit set $data where id = '$id'");
    if($query)
return 1;
}
else{
    //echo "update banner set heading='$title', decription='$desc' where id = '$id'";
$query = $this->db->query("update college_visit set college_name='$college_name',college_course='$college_course', college_title='$college_title', 	visit_date='$visit_date' where id = '$id'");
if($query)
return 1;
}
}
function  deletecollegevisit()
{
extract($_POST);
$delete = $this->db->query("DELETE FROM college_visit where id = ".$id);
if($delete)
return 1;
}
}