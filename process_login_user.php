<div style="width: 100%; text-align: center" >
	<h1>Jokes Application</h1><hr>
</div>

<h3>Login User</h3>
<div style="text-align: center">
<?php

session_start();

include "db_connection.php";

$username = $_POST['username'];
$password = $_POST['password'];

$username = addslashes($username);

$sql_statment = $mysqli->prepare("SELECT ID, Username, Password FROM user_table WHERE Username = ?");
$sql_statment->bind_param("s", $username);

$sql_statment->execute();
$sql_statment->store_result();

$sql_statment->bind_result($userid, $usernameDB, $passwordDB);

if($sql_statment->num_rows == 1){
    $sql_statment->fetch();
    if(password_verify($password, $passwordDB)){
        echo "Login Successfull!";
        
        $_SESSION['userid'] = $userid;
        $_SESSION['username'] = $usernameDB;
        
        exit;
    } else {
        session_destroy();
    }
} else {
    session_destroy();
}

echo "Login not successful!<br>";
echo '<a href="login_user.php">Login Page</a>';

?>
<br>
<a href="index.php">Home Page</a>

</div>