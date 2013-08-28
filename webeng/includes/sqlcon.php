<?php

// connection data for mysql
$db = @new MySQLi('localhost', 'root', 'root', 'blog_webeng');

// checks if establishing was successful, if not -> errormessage
if (mysqli_connect_errno()) {
    die('Could not establish database connection, error: '.mysqli_connect_error());
}
?>