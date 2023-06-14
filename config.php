<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'tcp:filrougematteojulien.database.windows.net,1433');
define('DB_USERNAME', 'CloudSAdeaa70e5');
define('DB_PASSWORD', 'xewpom-hocmuk-5deWha');
define('DB_NAME', 'filrouge');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>