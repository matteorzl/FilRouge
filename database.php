<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:filrougematteojulien.database.windows.net,1433; Database = filrouge", "CloudSAdeaa70e5", "xewpom-hocmuk-5deWha");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "CloudSAdeaa70e5", "pwd" => "{your_password_here}", "Database" => "filrouge", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:filrougematteojulien.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>