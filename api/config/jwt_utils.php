<?php require_once 'config/db.php';

function generate_jwt($headers, $payload, $secret = 'secret') {
	$headers_encoded = base64url_encode(json_encode($headers));
	
	$payload_encoded = base64url_encode(json_encode($payload));
	
	$signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
	$signature_encoded = base64url_encode($signature);
	
	$jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
	
	return $jwt;
}

function is_jwt_valid($jwt, $secret = 'secret') {
	// split the jwt
	$tokenParts = explode('.', $jwt);
	$header = base64_decode($tokenParts[0]);
	$payload = base64_decode($tokenParts[1]);
	$signature_provided = $tokenParts[2];

	// check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
	$expiration = json_decode($payload)->exp;
	$is_token_expired = ($expiration - time()) < 0;

	// build a signature based on the header and payload using the secret
	$base64_url_header = base64url_encode($header);
	$base64_url_payload = base64url_encode($payload);
	$signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
	$base64_url_signature = base64url_encode($signature);

	// verify it matches the signature provided in the jwt
	$is_signature_valid = ($base64_url_signature === $signature_provided);
	
	if ($is_token_expired || !$is_signature_valid) {
		return FALSE;
	} else {
		return TRUE;
	}
}


function new_is_jwt_valid($jwt, $secret = 'secret') {
    if(function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
    }
    $date=date('Y-m-d');
    $time=date('h:i:a'); 
    global $dbConn;
	// split the jwt
	$tokenParts = explode('.', $jwt);
	$consumer_key    = my_simple_crypt($tokenParts[0],'d');
	$consumer_secret = my_simple_crypt($tokenParts[1],'d'); 
	$ret_array = array();
// 	echo "SELECT * FROM tbl_key tk, tbl_admin ta WHERE tk.userid=ta.id and consumer_key='$consumer_key' AND consumer_secret='$consumer_secret' AND status='1'";
    $select = mysqli_query($dbConn,"SELECT * FROM tbl_key tk, tbl_admin ta WHERE tk.userid=ta.id and consumer_key='$consumer_key' AND consumer_secret='$consumer_secret' AND tk.status='1'");
    if(mysqli_num_rows($select)==1){
        $details = mysqli_fetch_assoc($select);
    //   echo "<pre>";
    //   print_r($details);
        $access  = $details['access'];
        $select = mysqli_query($dbConn,"UPDATE tbl_key SET lastuse='$date' WHERE consumer_key='$consumer_key' AND consumer_secret='$consumer_secret' AND status='1'");
        $ret_array = ['result'=>'success','access'=>$access,'username'=>  $details['name']];
        
    }else{
        $ret_array = ['result'=>'error','access'=>'No Access'];
    } 
    return $ret_array;
 
}

function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function get_authorization_header(){
	$headers = null;
	
	if (isset($_SERVER['Authorization'])) {
		$headers = trim($_SERVER["Authorization"]);
	} else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
		$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
	} else if (function_exists('apache_request_headers')) {
		$requestHeaders = apache_request_headers();
		// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
		$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
		//print_r($requestHeaders);
		if (isset($requestHeaders['Authorization'])) {
			$headers = trim($requestHeaders['Authorization']);
		}
	}
	
	return $headers;
}

function get_bearer_token() {
    $headers = get_authorization_header();
	
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}

 function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'hoffgun_live';
    $secret_iv = 'hoffgun_secret_key';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv  = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
    return $output;
} 


