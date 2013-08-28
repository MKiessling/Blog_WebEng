<?php
session_start();
$fun = isset($_GET['fun']) ? $_GET['fun'] : 0;
$id = isset($_GET['id']) ? $_GET['id'] : "";
$pid = isset($_GET['pid']) ? $_GET['pid'] : "";


include '../includes/phpheader.php';
include '../includes/sqlcon.php';
include '../includes/adminHeader.php';

include_once('../includes/loginfcts.php');

if ( !logged_in() ) {
    echo "<script language='javascript'>window.location.href='/webeng/index.php?fun=4';</script>";
}

if ( logged_in() ) {
$user = getUser();
echo "<div class=ribbon-wrapper-blue><div class=ribbon-blue>Admin</div></div>";
switch($fun){
	case 1:
		include 'entries/addEntry.php';
	break;
	case 2:
		include 'entries/editEntry.php';
	break;
	case 3:
		include 'entries/deleteEntry.php';
	break;
	case 4:
		include 'entries/getAdminEntry.php';
	break;
	case 5:
		include 'entries/deleteComment.php';
	break;
	case 6:
		include 'user/profile.php';
	break;
	case 7:
		include 'user/logout.php';
	break;
	case 8:
		include 'entries/addAdminComment.php';
	break;
	case 9:
		include 'entries/getWrittenEntries.php';
	break;
	case 10:
		include 'user/changepwd.php';
	break;
	default:
		include 'entries/getAdminEntries.php';
}
}
include "../includes/footer.php";
?>