<?php


	
$dbConn = mysqli_connect('localhost', 'root', '', 'masstortexpress') or die('MySQL connect failed. ' . mysqli_connect_error());
 
function dbQuery($sql) {
	global $dbConn;
	$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
	
	return $result;
}
function dbQuery1($sql) {
	global $dbConn;
	$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
	
	return mysqli_insert_id($dbConn);
}


function dbFetchAssoc($result) {
	return mysqli_fetch_assoc($result);
}

function dbNumRows($result) {
    return mysqli_num_rows($result);
}

function closeConn() {
	global $dbConn;
	mysqli_close($dbConn);
}

function generateQuery($objData, $uniqueKey ='id'){
	$parseQuery='';
	 foreach ($objData as $key => $value) {
		if ($key !== $uniqueKey) {
		$parseQuery .= " $key = '$value', ";
		}
	}
	$parseQuery = rtrim($parseQuery, ', ');
	return $parseQuery;
}
	
// 

//End of file