<?php
$newpwd = isset($_POST['newpwdagain']) ? $_POST['newpwdagain'] : "";

// change password form
$form = "
<form action='" . $_SERVER["SCRIPT_NAME"] . "?fun=10' method='post'>
<label>
  Old Password:<br>
  <input type='password' id='oldpwd' name='oldpwd' value='" . $oldpwd . "' onKeyUp=checkPwd('".session_id()."')></label>
  <span id='cor'></span>
<br>
<br>
<label>
  New Password:
  <br>
  <input type='password' id='newpwd' name='newpwd'>
</label>
<br>
<label>
  New Password again:
  <br>
  <input type='password' id='newpwdagain' name='newpwdagain' value='" . $newpwd . "' onKeyUp='checkNewPwd()'>
  <b><span id='newcor'></span></b>
</label>
<br>
<br>
<input type='submit' id='change' value='Change Password'>
</form>";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $newpwd != "") {

  $sql = 'UPDATE users
          SET password=md5("'.$newpwd.'")
          WHERE
            session = "'.session_id().'"';
  $result = $db->query($sql);
  if (!$result) {
    die ('Konnte den Query nicht senden :(');
  } else {        
  echo "<script language='javascript'>window.location.href='admin.php?fun=6';</script>";
  } 
}
else {

 // Formular ausgeben
 echo $form;
 echo '<script src="/webeng/admin/scripts/changePwd.js"></script>';
}
?>