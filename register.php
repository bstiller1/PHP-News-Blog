<?php
include 'errors.php';
$message = " ";
// Check to see if form was submitted via POST
if($_POST){
// Check for fname
if($_POST['fname']){
$fname = $_POST['fname'];	
} else {
	$message .= "First Name is required.<br />";
}
// Check for lname
if($_POST['lname']){
$lname = $_POST['lname'];	
} else {
	$message .= "Last Name is required.<br />";
}
// check for email
if($_POST['email']){
$email = $_POST['email'];	
	// split the email address in to 2 array elements called $domain[]
	$domain = explode("@", $email);
	// check the second piece of the $domain[1] array for the
	// domain to see if that web server has mail exchange records
	if(getmxrr($domain[1], $mxhosts) == FALSE){
		$message .= "That Email Address is not valid.<br />"; 
	} else {
    // The Email Address exists
    // try to query the DB
	try{
	// bring in the DB connection
	require 'dbconn.php';
    // Check to see if that Email Address exists in our DB
	  	$sql = "SELECT * FROM users WHERE email = '$email'";
	// execute SQL query
	$row = $db->prepare($sql);
	$row->execute();
	// Count results, if found $count == 1
	$count = $row->rowCount();
	// echo $count;
	} 
	// catch the Exception if it could not query the DB
	catch (Exception $e){
	// Display an error message as well as the system generated error
	$message .= "There was an error checking the DB for the Email Address: " . $e->getMessage();	
	} 	    // Email Address exists in the DB
			if ($count == 1){
				$message = "That Email Address already exists in our database.";
			}
		} // end getmxrr
	} else {
		$message .= "Email Address is required.<br />";
	}
// check password
if($_POST['pass']){
$pass = $_POST['pass'];	
}
// check confirm password
else if ($_POST['pass2']){
$pass2 = $_POST['pass2'];
// Check to see that the passwords match
  if ($pass != $pass2){
	$message .= "The passwords do not match.";  
  } else {
	  // Encrypt Password
	$encPass = md5($pass); 
	echo $encPass;

  } // end if
} else {
	$message .= "Please confirm your password.<br />";
}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
</head>

<body>
<p><?php echo $message; ?></p>
<form method="post">
<table>
    <tr>
    	<td>First Name:</td><td><input type="text" name="fname" required /></td>
    </tr>
    <tr>
   	 	<td>Last Name:</td><td><input type="text" name="lname" required /></td>
    </tr>
    <tr>
    	<td>Email Address:</td><td><input type="email" name="email" placeholder="email@website.com" required /></td>
    </tr>
    <tr>
    	<td>Password:</td><td><input type="password" name="pass" required /></td>
    </tr>
    <tr>
    	<td>Password:</td><td><input type="password" name="pass2" required /></td>
    </tr>
    <tr>
    	<td>&nbsp;</td><td><input type="submit" name="submit" value="Submit" /></td>
    </tr>
</table>
</form>
</body>
</html>