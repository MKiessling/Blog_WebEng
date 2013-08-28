<?php

include_once('loginfcts.php');
echo '<div class="ribbon-wrapper-blue"><div class="ribbon-blue">Login</div></div>';
if (isset($_POST['usr']) && isset($_POST['pwd'])) {
    $userid = check_user($_POST['usr'], $_POST['pwd']);
    if ( $userid ) {
        login($userid);
    } else {
        echo '<p style="color:red">Wrong username or password!</p>';
    }
}

if ( !logged_in() ) {
    echo <<<END
<form action="index.php?fun=4" method='post'>
<label>
  Username:
  <input type='text' name='usr' size='35'></label>
<br>
<br>
<label>
  Password:
  <input type='password' name='pwd' size='35'></label>
<br>
<br>
<input name='login' id='login' type='image' src='/webeng/images/login.png'>
</form>
END;
} else {
     echo "<script language='javascript'>window.location.href='/webeng/admin/admin.php';</script>";
}
?>