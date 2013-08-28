<?php

/*
 * add comment to entry
 */

echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Add</div></div>";

$titel = isset($_POST["titel"]) ? $_POST["titel"] : ""; // Titel
$text = isset($_POST["text"]) ? $_POST["text"] : ""; // Text
$name = isset($_POST["name"]) ? $_POST["name"] : ""; // Text
$sql = 'Select id from entries
          WHERE id ='.addslashes($id).';';

  // sends query to database  
  $result = $db->query($sql);

  if ($result->num_rows != 1){
    $id = "";
  }
if(is_numeric($id)){

// form to add a comment
$formular = "
<form action='" . $_SERVER["SCRIPT_NAME"] . "?fun=2&id=".$id."' method='post'>
<label>
  Your name:
  <input type='text' name='name' value='" . $name . "' size='35'></label>
<br>
<br>
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && $titel != "" && $text != "" && $name != "") {

  $name = htmlentities($name);
  $titel = htmlentities($titel);
  $text = htmlentities($text);

  // adds new comment to entry
  try {
    $sql = 'INSERT INTO comments(title, datecreated, content, postid, name)
          VALUES ("'.addslashes($titel).'",NOW(),"'.addslashes($text).'", "'.addslashes($id).'", "'.addslashes($name).'");';
        } catch(Exception $e) {
          // Do nothing
        }
  

  // sends query to database  
  $result = $db->query($sql);
  if (!$result) {
    die ('Konnte den Query nicht senden :(');
  } else {        
  echo "<script language='javascript'>window.location.href='index.php?fun=1&id=".$id."';</script>";
  } 
}
else {

 // show form
 echo $formular;
}
}else{
  echo 'Nicht so schnell Freundchen ;)';
}
?>