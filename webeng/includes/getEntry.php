<?php
/*
 * shows a single entry
 */

echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Entry</div></div>";

if(is_numeric($id)){
   // query returning information of blog-entries
    $sql = 'SELECT title, datecreated, content, datelastchanged, author, changedby 
        FROM entries 
        WHERE id = '.addslashes($id);

    // sends query to database
    $result = $db->query($sql);
    if (!$result) {
     die ('Konnte den Query nicht senden :(');
    } 
}


echo "<div id=entries>\n";

// if result contains rows -> show entry
if (!$result->num_rows) {
    echo 'No entries available!';
} else {
    while ($row = $result->fetch_assoc()) { 
             echo "<div class=sentry>\n";
             echo "<h2>".$row['title']."</h2>\n";
             echo "<b>Date created: ".$row['datecreated']." by <a href='/webeng/index.php?fun=7&user=".$row['author']."'>
             ".$row['author']."</a></b><br />\n";
             echo "<p>".$row['content']."</p>\n";
             echo "<small>Last changed: ".$row['datelastchanged']." by ".$row['changedby']."</small>\n";
             echo "</div>\n";
         }
    }

echo "</div>\n";
if(is_numeric($id)){
// query returnging information of comments
$sql = 'SELECT title, datecreated, content, name, flag 
        FROM comments
        WHERE postid = '.$id.'
        ORDER BY datecreated asc';

// sends query to database
$result = $db->query($sql);
if (!$result) {
    die ('Konnte den Query nicht senden :(');
}
}
echo "<div class=scomments>\n";
echo "<h2>Comments</h2>\n";

// if result contains rows -> show comments
if (!$result->num_rows) {
    echo 'No comments :(</br>';
} else {
    while ($row = $result->fetch_assoc()) { 
        if ($row['flag'] == 'a'){
            echo "<blockquote class=admincomment>\n";
        } else{
            echo "<blockquote class=usercomment>\n";
        }   
             echo "<b>".$row['title']."</b></br>\n";
             echo "<small>Date created: ".$row['datecreated']." by ".$row['name']."</small></br>\n";
             echo "<p>".$row['content']."</p>\n";
             echo "</blockquote>\n";
         }

    }        
echo "<a class=img href=index.php?fun=2&id=".$id."><img src='/webeng/images/newcomment.png'></a>";

echo "</div>\n";
?>