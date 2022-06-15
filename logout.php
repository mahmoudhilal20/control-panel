<?php
session_start();
session_unset();
session_destroy();
//end the session then redirect to the index page
header("refresh:1,url='index.php'");
echo("Successfully logged out. Redirecting to Login Page ");
?>