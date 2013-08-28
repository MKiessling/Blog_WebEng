<?php
if ( !logged_in() ) {
    echo "<script language='javascript'>window.location.href='/webeng';</script>";
}

logout();
?>