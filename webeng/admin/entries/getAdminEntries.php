<?php
echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Admin</div></div>";
echo "<a class=img href='admin.php?fun=1'><img src='/webeng/images/newentry.png'></a>";
$sql = 'SELECT entries.id, 
entries.title, 
entries.datecreated, 
entries.content, 
entries.datelastchanged,
entries.author,
entries.changedby, 
COUNT( comments.id ) AS count
FROM entries
LEFT OUTER JOIN comments ON entries.id = comments.postid
GROUP BY entries.id
ORDER BY entries.id DESC';

$result = $db->query($sql);
if (!$result) {
   die ('Konnte den Query nicht senden :(');
}
echo "<div id=entries>\n";
if (!$result->num_rows) {
    echo 'No entries available!';
} else {
    while ($row = $result->fetch_assoc()) { 
             echo "<div class=entry>\n";
             echo "<h2>".$row['title']."</h2>\n";
             echo "<b>Date created: ".$row['datecreated']." by ".$row['author']."</b><br />\n";
             echo "<p>".$row['content']."</p>\n";
             echo "<small>Last changed: ".$row['datelastchanged']." by ".$row['changedby']."</small>\n";
             echo "</div>\n";
             echo "<div class=comments>\n";
             echo "<a href=admin.php?fun=2&id=".$row['id'].">Edit</a>&nbsp;&nbsp;";
             echo "<a href=admin.php?fun=3&id=".$row['id'].">Delete</a>&nbsp;&nbsp;";
             if($row['count'] != null){
                $comcount = $row['count'];
             } else{
                $comcount = 0;
             }
             echo "<a href=admin.php?fun=4&id=".$row['id'].">Comments (".$comcount.")</a>";
             echo "</div>\n";
         }
    }
echo "</div>\n";
?>