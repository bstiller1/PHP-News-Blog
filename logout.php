<?php
// Start session to check if they are logged in
session_start();
if($_SESSION){
// unset($_SESSION['email']);
session_destroy();
session_unset();
echo "You are now logged out.<br />";
echo "<a href='index.php' title='Home'>News Blog Home</a>";
//header("Location:index.php");
}
?>