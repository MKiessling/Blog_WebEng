<?php+

$user = isset($_GET['user']) ? $_GET['user'] : "";
echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Profile</div></div>";
$user = stripslashes($user);
$user = mysql_real_escape_string($user);
$sql = 'Select usergroup, about from users WHERE username = \'' . $user . '\'';
$result = $db->query($sql);
if (!$result) {
    die ('Konnte den Query nicht senden :(');
  }
if (!$result->num_rows) {
    echo 'No data available!';
} else {
    while ($row = $result->fetch_assoc()) { 
             $about = $row['about'];
             $group = $row['usergroup'];
         }
    }
// Userprofile
echo "<h2>".$user."</h2><br><br>";
echo "<b>Gruppe: </b>".$group."<br><br>";
echo "<b>Über:</b>";
echo "<pre class=aboutme>".$about."</pre>";
echo "<a href='index.php?fun=6&user=".$user."'>Show user entries</a>";
?>