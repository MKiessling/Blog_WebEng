<?php
echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Edit</div></div>";
// Schreibt den Inhalt des Eintrags in das Formular
$titel = isset($_POST["titel"]) ? $_POST["titel"] : ""; // Titel
$text = isset($_POST["text"]) ? $_POST["text"] : ""; // Text

if($titel == ""){
$sql = 'SELECT
    title,
    content
FROM
    entries
WHERE
    id = "'.$id.'"';
$result = $db->query($sql);
if (!$result) {
    die ('Konnte den Query nicht senden :(');
  }
if (!$result->num_rows) {
    echo 'No entries available!';
} else {
    while ($row = $result->fetch_assoc()) { 
             $titel = $row['title'];
             $text = $row['content'];
         }
         $done = 1;
    }
}
// Formular erstellen
$formular = "
<form action='" . $_SERVER["SCRIPT_NAME"] . "?fun=2&id=".$id."' method='post'>
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
<input type='submit' value='Submit edit'>
</form>";

// Wurde das Formular abgesendet
if ($_SERVER["REQUEST_METHOD"] == "POST" && $titel != "" && $text != "") {

  // updated den Eintrag
  $sql = 'UPDATE entries
          SET title="'.addslashes($titel).'", content="'.addslashes($text).'", datelastchanged=NOW(), changedby="'.$user.'"
          WHERE
            id = "'.$id.'"';
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