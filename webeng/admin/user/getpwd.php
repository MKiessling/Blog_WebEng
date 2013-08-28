<?php
$session = $_GET["session"];
$pwd = $_GET["pwd"];

$con = mysql_connect('localhost', 'root', 'root');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("martink1_webeng", $con);

$sql = "SELECT password FROM users WHERE session = '".$session."'";

$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){
  if ($row['password'] == md5($pwd)){
    $response = "<b style='color:green'>old password correct</b>";
  } else{
    $response = "<b style='color:red'>old password not correct</b>";
  }
  echo $response;
}
mysql_close($con);
?>
