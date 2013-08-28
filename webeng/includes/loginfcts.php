<?php  

/*
 * contains functions for login
 */

 /**
 * data for database connection
 * @return void
 */
function connect () { 
    $con = mysql_connect('localhost', 'root', 'root') or exit(mysql_error());
    mysql_select_db('blog_webeng', $con) or exit(mysql_error());
}

 /**
 * checks login-data
 * @return integer
 */
function check_user ( $name, $pass ) {
    // if magic quotes are on -> remove every quotes from a quoted string
    if ( get_magic_quotes_gpc() ) {
        $name = stripslashes($name);
        $pass = stripslashes($pass);
    }
    // masks \\, \x00, \n, \r, \, ', " und \x1a in a string
    $name = mysql_real_escape_string($name);
    // masks % and _
    $name = str_replace('%', '\%', $name);
    $name = str_replace('_', '\_', $name);

    // query to check if username and password combination is in the database
    $sql = 'SELECT id FROM users WHERE username = \'' . $name . '\' AND password=\'' . md5($pass) . '\'';
    if ( !$result = mysql_query($sql) ) {
        exit(mysql_error());
    }
    if ( mysql_num_rows($result) == 1 ) {
        $user = mysql_fetch_assoc($result);
        return ( $user['id'] );
    } else {
        return ( false );
    }
}



/**
 * returns username from current sessionID
 * @return String
 */
function getUser(){
    $sql = 'Select username from users WHERE session = \'' . session_id() . '\'';
    if ( $result = mysql_query($sql) ) {
        $user = mysql_fetch_assoc($result);
        return ( $user['username'] );
    }
}

/**
 * sets sessionID to active user
 * @param int $userid
 * @return void
 */
function login ( $userid ) {
    $sql = 'UPDATE users SET session = \'' . session_id() . '\' WHERE id = ' . ((int)$userid);
    if ( !mysql_query($sql) ) {
        exit(mysql_error());
    }
}


/**
 * checks whether user is logged in or not
 * @return boolean
 */
function logged_in () { 
    $sql = 'SELECT id FROM users WHERE session = \'' . session_id() . '\'';
    if ( !$result = mysql_query($sql) ) {
        exit(mysql_error());
    }
    return (mysql_num_rows($result) == 1);
}


/**
 * user will be logged out
 * @return void
 */
function logout () { 
    $sql = 'UPDATE users SET session = NULL WHERE session = \'' . session_id() . '\'';
    if ( mysql_query($sql) ) {
        echo "<script language='javascript'>window.location.href='/webeng';</script>";
        exit(mysql_error());
    }
}

connect();
?>