<?php
  // löscht den Eintrag
  $sql = 'DELETE FROM comments
          WHERE
          postid = "'.$id.'"';
  $result = $db->query($sql);
  if (!$result) {
    die ('Konnte den Query nicht senden :(');
  } 
  $sql = 'DELETE FROM entries
          WHERE
          id = "'.$id.'"';
  $result = $db->query($sql);
  if (!$result) {
    die ('Konnte den Query nicht senden :(');
  } else {        
  echo "<script language='javascript'>window.location.href='admin.php';</script>";
  } 
?>