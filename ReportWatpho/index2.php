<?php
//phpinfo();
//include("includes/database.php");
//$db = new Database();
ini_set('display_errors', 1);
$serverName = "27.254.81.223";
$userName = "ktsoft";
$userPassword = "ktsoft";
$dbName = "WAT2";
$conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
$sql = "SELECT * FROM tb_sales";
$stmt = $conn->prepare($sql);
$stmt->execute();
while($result = $stmt->fetch( PDO::FETCH_ASSOC ))
{
    echo $result["sale_id"];
}