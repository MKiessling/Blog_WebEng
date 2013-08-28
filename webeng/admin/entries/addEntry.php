<?php
$titel = isset($_POST["titel"]) ? $_POST["titel"] : ""; // Titel
$text = isset($_POST["text"]) ? $_POST["text"] : ""; // Text

// Formular erstellen
$formular = "
<form action='" . $_SERVER["SCRIPT_NAME"] . "?fun=1' method='post'>
<label>
  Title:
  <input type='text' name='titel' value='" . $titel . "' size='35'></label>
<br>
<br>
<label>
  Text:
  <br>
  <textarea name='text' cols='100' rows='20'>" . $text . "</textarea>
</label>
<br>
<br>
<input type='submit' value='Add entry'>
</form>";

// Wurde das Formular abgesendet
if ($_SERVER["REQUEST_METHOD"] == "POST" && $titel != "" && $text != "") {

  // fügt neuen Eintrag in die DB
  $sql = 'INSERT INTO 
            entries(title, datecreated, content, datelastchanged, author, changedby)
          VALUES
            ("'.addslashes($titel).'", NOW(), "'.addslashes($text).'", NOW(), "'.$user.'", "'.$user.'");';
  $result = $db->query($sql);
  if (!$result) {
    die ('Konnte den Query nicht senden :(');
  } else {        
  echo "<script language='javascript'>window.location.href='admin.php';</script>";
  } 
}
else {

 // Formular ausgeben
 echo $formular;
}
?>