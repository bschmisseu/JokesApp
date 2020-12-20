<div style="width: 100%; text-align: center" >
	<h1>Jokes Application</h1><hr>
</div>

<h3>Logout</h3>
<div style="text-align: center">
<?php

session_start();

$_SESSION = [];

session_destroy();

echo "Sucessfully Logged Out!"

?>
<br>
<a href="index.php">Home Page</a>

</div>