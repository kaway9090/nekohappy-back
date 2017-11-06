<?php
$conn = mysql_connect('localhost','root','') or die (mysql_error);
$db=mysql_select_db('nekohappy', $conn) or die (mysql_error);
?>