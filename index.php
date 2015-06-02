<?php require 'dbconn.php'; 
$sql = "SELECT * FROM news ORDER BY date";
$posts = $db->query($sql);

if(@$_POST['edited'])
{
	// set timezone to EST
date_default_timezone_set('US/Eastern');
// set date variable to mm/dd/yyyy
$date = date('m/d/Y h:m:s');
$edited = $_POST['edited'];
$editID = $_POST['editID'];
try {
	// SQL query in the $sql variable
	$update = "UPDATE news SET post = '$edited', date = '$date' WHERE id = '$editID'";
	// execute SQL query
	$db->query($update);
	// Redirect to the homepage to see entries
	header( 'Location: index.php');
} catch (Exception $e){
// Display an error message as well as the system generated error
	echo "There was an error updating news: " . $e->getMessage();		
}
}

// Start session to check if they are logged in
session_start();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>News</title>
</head>

<body>
<?php

// if Session variable "email" is found the user is logged in
// and can see the logout link
if ($_SESSION){
if (@!$_SESSION['email']){
	echo "<a href='login.php' title='Login'>Login</a>";
} else {
	echo "<a href='logout.php' title='Logout'>Logout</a>";
}
} 
// If no SESSION is found at all display "Login" link
if (!$_SESSION){
	echo "<a href='login.php' title='Login'>Login</a>";
}
	?>
    

<table>
	<tr>
    	<th>Post</th><th>Date</th>
        <?php
		// if Session variable "email" is found the user is logged in
		// and can see the edit and delete link
        if ($_SESSION){
		if (@$_SESSION['email']){
		echo "<th>Edit</th><th>Delete</th>";	
   		echo "</tr>\n";
	// if editing posts
	if(@$_GET['edit'] == 'yes'){
		echo "<th>Commit</th>";
		echo "</tr>\n";
	// add text fields with data from DB
	foreach($posts as $post):
	echo "<tr>\n";
	echo "<form name='form".$post['id']."' method='post'>";
	echo "<input type='hidden' name='editID' value='".$post['id']."' />";
	echo "<td><input type='text' name='edited' value='".$post['post']."'/></td>\n";
	echo "<td>".$post['date']."</td>\n";   
	echo "<td><a href='javascript:form".$post['id'].".submit();'>Commit</a>\n";
	echo "</form>";
		endforeach;
	} else { // not editing posts just logged in
	foreach($posts as $post):
	echo "<tr>\n";
	echo "<td>".$post['post']."</td>\n";
	echo "<td>".$post['date']. "</td>\n";   
	echo "<td><a href='index.php?edit=yes' title='Edit'>Edit</a></td>\n";
			echo "<td><a href='deleteNews.php?delete=maybe&id=".$post['id']."' title='DELETE'>Delete</a></td>\n";
		endforeach;
		} // end else	
   } // end email check 
} // end session check
// if they are not logged in show data in read only
if(!@$_SESSION['email']){
	foreach($posts as $post){
	echo "<tr>\n";
	echo "<td>".$post['post']."</td>\n";
	echo "<td>".$post['date']. "</td>\n";
	}
   }
		?>
    </tr>
</table>

<?php
// if Session variable "email" is found the user is logged in
// and can see the Add News link
if ($_SESSION){
if (@$_SESSION['email']){
	echo "<p>Add a News post: <a href='insertNews.php' title='Add'>Add</a></p>";
}
}
?>
</body>
</html>