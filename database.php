<?php
// SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "CloudSAdeaa70e5", "pwd" => "xewpom-hocmuk-5deWha", "Database" => "filrouge", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:filrougematteojulien.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      echo "Connected successfully";
?>