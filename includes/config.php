<?php
// define('DB_SERVER','localhost');
// // server
// // define('DB_USER','yqbhzkmy_career');
// // define('DB_PASS' ,'CVdjfk4yXSDEY$$');
// // local
// define('DB_USER','root');
// define('DB_PASS' ,'');
// define('DB_NAME','yqbhzkmy_career');
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME','masstortexpress');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>