<?php

$pfun = isset($_GET['pfun']) ? $_GET['pfun'] : "";
echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Profile</div></div>";

$sql = 'Select session, usergroup, about from users WHERE session = \'' . session_id() . '\'';
$result = $db->query($sql);
if (!$result) {
    die ('Konnte den Query nicht senden :(');
  }
if (!$result->num_rows) {
    echo 'No entries available!';
} else {
    while ($row = $result->fetch_assoc()) { 
             $session = $row['session'];
             $group = $row['usergroup'];
             $about = $row['about'];
         }
    }
switch ($pfun) {
	case 1:
		$about = isset($_POST["about"]) ? $_POST["about"] : ""; 
		$formular = "
		<form action='" . $_SERVER["SCRIPT_NAME"] . "?fun=6&pfun=1' method='post'>
		<label>
 		About me:
  		<br>
  		<textarea name='about' cols='100' rows='20'>" . $about . "</textarea>
		</label>
		<br>
		<br>
		<input type='submit' value='Submit edit'>
		</form>";

		// Wurde das Formular abgesendet
		if ($_SERVER["REQUEST_METHOD"] == "POST" && $about != "") {

 		 // updated den Eintrag
  			$sql = 'UPDATE users
             	    SET about="'.$about.'"
          			WHERE
            		session = \'' . session_id() . '\'';
  			$result = $db->query($sql);
  			if (!$result) {
    			die ('Konnte den Query nicht senden :(');
  				} else {        
  				echo "<script language='javascript'>window.location.href='admin.php?fun=6';</script>";
  				} 
			}else {
 			// Formular ausgeben
 			echo $formular;
			}
		break;
	
	default:
		// Userprofile
		echo "<b>Username: </b>".$user."<br><br>";
		echo "<b>Session-ID: </b>".$session."<br><br>";
		echo "<b>Gruppe: </b>".$group."<br><br>";
		echo "<b>About me <a href=admin.php?fun=6&pfun=1>[Edit]</a>:</b><br>";
		echo "<pre class=aboutme>".$about."</pre>";
		echo "<a class=img href='admin.php?fun=9'><img src='/webeng/images/myentries.png'></a>&nbsp;&nbsp;";
		echo "<a class=img href='admin.php?fun=10'><img src='/webeng/images/changepwd.png'></a>";
		break;
}
?>