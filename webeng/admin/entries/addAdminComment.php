<?php

/*
 * add admin-comment to entry
 */

echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Add</div></div>";

$titel = isset($_POST["titel"]) ? $_POST["titel"] : ""; // Titel
$text = isset($_POST["text"]) ? $_POST["text"] : ""; // Text

// form to add a comment
$formular = "
<form action='" . $_SERVER["SCRIPT_NAME"] . "?fun=8&id=".$id."' method='post'>
<label>
  Title:
  <input type='text' name='titel' value='" . $titel . "' size='35'></label>
<br>
<br>
<label>
  Your comment:
  <br>
  <textarea name='text' cols='100' rows='20'>" . $text . "</textarea>
</label>
<br>
<br>
<input type='submit' value='Submit comment'>
</form>";

// if form was sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && $titel != "" && $text != "") {

  // adds new comment to entry
  $sql = 'INSERT INTO comments(title, datecreated, content, postid, name, flag)
          VALUES ("'.$titel.'",NOW(),"'.$text.'", "'.$id.'", "'.$user.'","a");';

  // sends query to database  
  $result = $db->query($sql);
  if (!$result) {
    die ('Konnte den Query nicht senden :(');
  } else {        
  echo "<script language='javascript'>window.location.href='admin.php?fun=4&id=".$id."';</script>";
  } 
}
else {

 // show form
 echo $formular;
}
?>