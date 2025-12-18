<?php
require_once 'config/db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
	 $data = json_decode(file_get_contents("php://input", true));
     $parseQuery='';
     $uniqueKey ="id";
     $parseQery= generateQuery($data, $uniqueKey) ;
    
    $qry = "INSERT INTO `user_query` SET  $parseQery";
    $exe = dbQuery($qry);
        if($exe==1){ 
        header('Content-type: application/json');
    	echo json_encode(array('status' => true,  "message"=>"Query submitted successfully"));    
        }else{
        header('Content-type: application/json');
    	echo json_encode(array('status' => false, "message"=>"Sorry some error occurred"));    
        }
}else {
    header('Content-type: application/json');
	echo json_encode(array('status'=>false, 'message' => 'Invalid method. Access denied'));
}	
