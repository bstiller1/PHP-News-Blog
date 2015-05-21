<?php
$id = $_GET['id'];
$delete = $_GET['delete'];
echo "Are you sure you would like to delete that news post?";
echo "<a href='deleteNews.php?delete=yes&id=".$id."' title='Yes'>Yes</a> ";
echo "<a href='index.php' title='No'>no</a> ";
 
if($delete == 'yes'){
require 'dbconn.php';
$sql = "DELETE FROM news WHERE id = '$id'";
$db->query($sql);
echo "<script>alert('Post Deleted!');location.href='index.php';</script>";
}
?>