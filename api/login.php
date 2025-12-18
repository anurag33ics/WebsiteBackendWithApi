<?php


require_once 'config/db.php';
require_once 'config/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//if (isset($_POST['submit'])) {
//	get posted data
	$data = json_decode(file_get_contents("php://input", true));

	$username = mysqli_real_escape_string($dbConn, $data->username);
	$password = mysqli_real_escape_string($dbConn, $data->password);
	
	$encPassword = md5($password);
	
	$sql = "SELECT * FROM tbl_admin WHERE username = '".$username."' AND password = '".$encPassword."' AND type='API' LIMIT 1";
	 
	$result = dbQuery($sql); 
	if(dbNumRows($result) < 1) {
		echo json_encode(array('error' => 'Invalid User'));
	} else {
		$row = dbFetchAssoc($result);
		
		$username = $row['username'];
		
		$headers = array('alg'=>'HS256','typ'=>'JWT');
// 		$payload = array('username'=>$username, 'exp'=>(time() + 60 * 3600*24*365*10));
        $payload = array('username'=>$username, 'exp'=>(time() + 60 *10));

		$jwt = generate_jwt($headers, $payload); 

		if($jwt) {			 
			echo json_encode(array('status'=>'true','token' => $jwt));
		} else {
			echo json_encode(array('status'=>'false','error' => 'Access denied'));
		}

	}
}
  

?>

  
 