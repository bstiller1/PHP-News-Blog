<?php
// header('Access-Control-Allow-Origin: http://localhost:50898');
// header('Access-Control-Allow-Origin: http://triosdevelopers.com');
// header('Access-Control-Allow-Credentials: true');
if($_POST){
foreach ($_POST as $field_num => $field_value) {

        $submission .= "$field_num : $field_value <br />\n";
}


print $submission;
}

if($_GET){
foreach ($_GET as $field_num => $field_value) {

        $submission .= "$field_num : $field_value <br />\n";
}


print $submission;
}
?> 