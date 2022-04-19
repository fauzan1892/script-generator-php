<?php 
$dbhost = $_POST['host']; // set the hostname
$dbuser = $_POST['user']; // set the mysql username
$dbpass = $_POST['pass'];  // set the mysql password
$dbname = $_POST['dbname'];  // set the mysql name 
try{
    $DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $DBH->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(PDOException $e) {
    echo "Fail";
}
  
$rs = $DBH->query("SHOW TABLES");
$result = [];
while ($h = $rs->fetch(PDO::FETCH_NUM)) {
    $result[] = $h[0];
}
echo json_encode($result);
  