<?php
  // löscht den Eintrag
  $sql = 'DELETE FROM comments
          WHERE
          id = "'.$id.'"';
  $result = $db->query($sql);
  if (!$result) {
    die ('Konnte den Query nicht senden :(');
  } else {        
  echo "<script language='javascript'>window.location.href='admin.php?fun=4&id=".$pid."';</script>";
  } 
?>