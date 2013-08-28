<?php
$user = isset($_GET['user']) ? $_GET['user'] : "";
$user = stripslashes($user);
$user = mysql_real_escape_string($user);
echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Entries</div></div>";
echo '<h1>Entries from '.$user.'</h1>';
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
WHERE entries.author = "'.$user.'"
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
             echo "<b>Date created: ".$row['datecreated']." by <a href='/webeng/index.php?fun=7&user=".$row['author']."'>
             ".$row['author']."</a></b><br />\n";
             echo "<p>".$row['content']."</p>\n";
             echo "<small>Last changed: ".$row['datelastchanged']." by ".$row['changedby']."</small>\n";
             echo "</div>\n";
             echo "<div class=comments>\n";
             if($row['count'] != null){
                $comcount = $row['count'];
             } else{
                $comcount = 0;
             }
             echo "<a href=index.php?fun=1&id=".$row['id'].">Comments (".$comcount.")</a>";
             echo "</div>\n";
         }
    }
echo "</div>\n";
?>