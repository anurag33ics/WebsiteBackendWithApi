<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

// added new
if($action == 'deletemember'){
	$addslider = $crud->deletemember();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteFeedback'){
	$addslider = $crud->deleteFeedback();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteAlumni'){
	$addslider = $crud->deleteAlumni();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteFaculty'){
	$addslider = $crud->deleteFaculty();
	if($addslider)
		echo $addslider;
}
if($action == 'addFaculty'){
	$addslider = $crud->addFaculty();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteTC'){
	$addslider = $crud->deleteTC();
	if($addslider)
		echo $addslider;
}
if($action == 'addTC'){
	$addslider = $crud->addTC();
	if($addslider)
		echo $addslider;
}
if($action == 'addNews'){
	$addslider = $crud->addNews();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteNews'){
	$addslider = $crud->deleteNews();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteEvent'){
	$addslider = $crud->deleteEvent();
	if($addslider)
		echo $addslider;
}
if($action == 'addEvent'){
	$addslider = $crud->addEvent();
	if($addslider)
		echo $addslider;
}
if($action == 'addNotice'){
	$addslider = $crud->addNotice();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteNotice'){
	$addslider = $crud->deleteNotice();
	if($addslider)
		echo $addslider;
}
if($action == 'addLightboxImage'){
	$addslider = $crud->addLightboxImage();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteLightboxImage'){
	$addslider = $crud->deleteLightboxImage();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteAlbum'){
	$addslider = $crud->deleteAlbum();
	if($addslider)
		echo $addslider;
}
if($action == 'addAlbum'){
	$addslider = $crud->addAlbum();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteImage'){
	$addslider = $crud->deleteImage();
	if($addslider)
		echo $addslider;
}
if($action == 'addImageToAlbum'){
	$addslider = $crud->addImageToAlbum();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteGroup'){
	$addslider = $crud->deleteGroup();
	if($addslider)
		echo $addslider;
}

if($action == 'addGroup'){
	$addslider = $crud->addGroup();
	if($addslider)
		echo $addslider;
}

if($action == 'addSubjectType'){
	$addslider = $crud->addSubjectType();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteRecord'){
	$addslider = $crud->deleteRecord();
	if($addslider)
		echo $addslider;
}

if($action == 'addSubject'){
	$addslider = $crud->addSubject();
	if($addslider) 
		echo $addslider;
}
if($action == 'addGrade'){
	$addslider = $crud->addGrade();
	if($addslider) 
		echo $addslider;
}
if($action == 'addToppers'){
	$addslider = $crud->addToppers();
	if($addslider) 
		echo $addslider;
}
if($action == 'addadd_faulty_image'){
	$addslider = $crud->addadd_faulty_image();
	if($addslider) 
		echo $addslider;
}



// 



if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'unsubscribe'){
	$addslider = $crud->unsubscribe();
	if($addslider)
		echo $addslider;
}

if($action == 'deleteunsubscribe'){
	$addslider = $crud->deleteunsubscribe();
	if($addslider)
		echo $addslider;
}

if($action == 'addcollege'){
	$addslider = $crud->addcollege();
	if($addslider)
		echo $addslider;
}
if($action == 'deletelist'){
	$addslider = $crud->deletelist();
	if($addslider)
		echo $addslider;
}
if($action == 'addlistmember'){
	$addslider = $crud->addlistmember();
	if($addslider)
		echo $addslider;
}
if($action == 'listmem'){
	$addslider = $crud->listmem();
	if($addslider)
		echo $addslider;
}


if($action == 'editlist'){
	$addslider = $crud->editlist();
	if($addslider)
		echo $addslider;
}
if($action == 'editcollege'){
	$addslider = $crud->editcollege();
	if($addslider)
		echo $addslider;
}




if($action == 'editmember'){
	$addslider = $crud->editmember();
	if($addslider)
		echo $addslider;
}

if($action == 'addcsvfile'){
	$addslider = $crud->addcsvfile();
	if($addslider)
		echo $addslider;
}
 
if($action == 'sendmail'){
	$addslider = $crud->sendmail();
	if($addslider)
		echo $addslider;
}

if($action == 'viewTemplate'){
	$addslider = $crud->viewTemplate();
	if($addslider)
		echo $addslider;
}

if($action == 'sendTestEmail'){
	$addslider = $crud->sendTestEmail();
	if($addslider)
		echo $addslider;
}

if($action == 'sendtemplateEamil'){
	$addslider = $crud->sendtemplateEamil();
	if($addslider)
		echo $addslider;
}

if($action == 'addCampaign'){
	$addslider = $crud->addCampaign();
	if($addslider)
		echo $addslider;
}

if($action == 'deleteCampaign'){
	$addslider = $crud->deleteCampaign();
	if($addslider)
		echo $addslider;
}

if($action == 'editCampaign'){
	$addslider = $crud->editCampaign();
	if($addslider)
		echo $addslider;
}

if($action == 'filtercamp'){
	$addslider = $crud->filtercamp();
	if($addslider)
		echo $addslider;
}
if($action == 'adduser'){
	$addslider = $crud->adduser();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteuser'){
	$addslider = $crud->deleteuser();
	if($addslider)
		echo $addslider;
}
if($action == 'deleteuserquery'){
	$addslider = $crud->deleteuserquery();
	if($addslider)
		echo $addslider;
}

if($action == 'edituser'){
	$addslider = $crud->edituser();
	if($addslider)
		echo $addslider;
}

if($action == 'changepass'){
	$addslider = $crud->changepass();
	if($addslider)
		echo $addslider;
}

if($action == 'changeprofile'){
	$addslider = $crud->changeprofiles();
	if($addslider)
		echo $addslider;
}
if($action == 'addpoc'){
	$addslider = $crud->addpoc();
	if($addslider)
		echo $addslider;
}
if($action == 'editpoc'){
	$addslider = $crud->editpoc();
	if($addslider)
		echo $addslider;
}
if($action == 'deletepoc'){
	$addslider = $crud->deletepoc();
	if($addslider)
		echo $addslider;
}

if($action == 'addbanner'){
	$addslider = $crud->addbanner();
	if($addslider)
		echo $addslider;
}

if($action == 'editbanner'){
	$addslider = $crud->editbanner();
	if($addslider)
		echo $addslider;
}
if($action == 'deletebanner'){
	$addslider = $crud->deletebanner();
	if($addslider)
		echo $addslider;
}

if($action == 'addcollgevisit'){
	$addslider = $crud->addcollgevisit();
	if($addslider)
		echo $addslider;
}
if($action == 'deletecollegevisit'){
	$addslider = $crud->deletecollegevisit();
	if($addslider)
		echo $addslider;
}

if($action == 'editcollegevisit'){
	$addslider = $crud->editcollegevisit();
	if($addslider)
		echo $addslider;
}

if($action == 'edituserdata'){
	$addslider = $crud->edituserdata();
	if($addslider)
		echo $addslider;
}

if($action == 'resume_upload'){
	$addslider = $crud->resume_upload();
	if($addslider)
		echo $addslider;
}