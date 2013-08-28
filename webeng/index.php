<?php
/*
 * startpage
 */

// for working with sessions
session_start();

// variables and includes
$fun = isset($_GET['fun']) ? $_GET['fun'] : 0;
$id = isset($_GET['id']) ? $_GET['id'] : "";
include 'includes/phpheader.php';
include 'includes/sqlcon.php';
include_once('includes/loginfcts.php');

// if user is not logged in -> include standard-header
if ( !logged_in() ) {
   include 'includes/header.php';
}

// if user is logged in -> include admin-header
if ( logged_in() ) {
    echo "<script language='javascript'>window.location.href='/webeng/admin/admin.php';</script>";
}

// switches through the different functions for guests
 switch($fun){
	case 1:
		include 'includes/getEntry.php';
	break;
	case 2:
		include 'includes/addComment.php';
	break;
	case 3:
		include 'includes/getEntries.php';
	break;
    case 4:
        include 'includes/login.php';
        break;
    case 5:
        include 'includes/disclaimer.php';
    break;
    case 6:
        include 'includes/getUserEntries.php';
    break;
    case 7:
        include 'includes/getUser.php';
    break;
	default:
		include 'includes/welcome.php';
 }
// standard footer for guests
include "includes/footer.php";
?>