<?php require 'dbconn.php'; 
$sql = "SELECT post, date FROM news";
$posts = $db->query($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>News</title>
</head>

<body>
<table>
	<tr>
    	<th>Post</th><th>Date</th>
    </tr>
    <?php foreach($posts as $post) : ?>
	<tr>
    	<td><?php echo $post['post']; ?></td>
        <td><?php echo $post['date']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<p>Add a News post: <a href="insertNews.php" title="Add">Add</a></p>
</body>
</html>