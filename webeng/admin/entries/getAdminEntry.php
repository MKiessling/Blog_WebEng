<?php
echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Admin</div></div>";
$sql = 'SELECT  
title, 
datecreated, 
content, 
datelastchanged,
author,
changedby 
from entries where id = '.$id;

$result = $db->query($sql);
if (!$result) {
    die ('Konnte den Query nicht senden :(');
}
echo "<div id=entries>\n";
if (!$result->num_rows) {
    echo 'No entries available!';
} else {
    while ($row = $result->fetch_assoc()) { 
             echo "<div class=sentry>\n";
             echo "<h2>".$row['title']."</h2>\n";
             echo "<b>Date created: ".$row['datecreated']." by ".$row['author']."</b><br />\n";
             echo "<p>".$row['content']."</p>\n";
             echo "<small>Last changed: ".$row['datelastchanged']." by ".$row['changedby']."</small>\n";
             echo "</div>\n";
         }
    }
echo "</div>\n";
$sql = 'SELECT id,
title,
datecreated,
content,
name,
flag
from comments
where postid = '.$id.'
order by datecreated asc';

$result = $db->query($sql);
if (!$result) {
    die ('Konnte den Query nicht senden :(');
}
echo "<div class=scomments>\n";
echo "<h2>Comments</h2>\n";
if (!$result->num_rows) {
    echo 'No comments :(</br>';
} else {
    while ($row = $result->fetch_assoc()) { 
        if ($row['flag'] == 'a'){
            echo "<blockquote class=admincomment>\n";
        } else{
            echo "<blockquote class=usercomment>\n";
        }   
             echo "<b>".$row['title']."</b>&nbsp;&nbsp;<a href='admin.php?fun=5&id=".$row['id']."&pid=".$id."' style='color:red'>[Delete]</a>\n</br>";
             echo "<small>Date created: ".$row['datecreated']." by ".$row['name']."</small></br>\n";
             echo "<p>".$row['content']."</p>\n";
             echo "</blockquote>\n";
         }
    }       
echo "<a class=img href=admin.php?fun=8&id=".$id."><img src='/webeng/images/newcomment.png'></a>"; 
echo "</div>\n";
?>