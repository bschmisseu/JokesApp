<div style="width: 100%; text-align: center" >
	<h1>Jokes Application</h1><hr>
</div>

<h3>Registration</h3>
<div style="text-align: center">
<?php

include "db_connection.php";

$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2= $_POST['password2'];

$hashed_password = password_hash($password1, PASSWORD_DEFAULT);

preg_match('/[0-9]+/', $password1, $matches);
if(sizeof($matches) == 0){
    echo "The passwords must contain atleast one number!<br>";
    echo '<a href="register_user.php">Back to registration</a>';
    exit; 
}

preg_match('/[!@#$%^&*()]/', $password1, $matches);
if(sizeof($matches) == 0){
    echo "The passwords must contain atleast one symbol e.g. '!@#$%^&*()'<br>";
    echo '<a href="register_user.php">Back to registration</a>';
    exit;
}

if(strlen($password1) <= 8){
    echo "The passwords must contain atleast 8 characters!<br>";
    echo '<a href="register_user.php">Back to registration</a>';
    exit;
}

//Check to see if the user is already created
$sql_statment = "SELECT * FROM user_table WHERE Username LIKE '$username'";
$results = $mysqli->query($sql_statment) /* or die mysqli_error($mysqli) */;

if($results->num_rows > 0){
    echo "The user with the name <i>" . $username . "</i> already exist!!<br>";
    echo '<a href="register_user.php">Registration Page</a>';
    exit;
}

//Check to see if the passwords dont match 
if($password1 != $password2){
    echo "The passwords do not match please try again!!<br>";
    echo '<a href="register_user.php">Registration Page</a>';
    exit;
}

$username = addslashes($username);
    
//Insert a user to the database
$sql_statment = $mysqli->prepare("INSERT INTO user_table (ID, Username, Password) VALUES (null, ?, ?)");
$sql_statment->bind_param("ss", $username, $hashed_password);

if($sql_statment->execute()){
    echo "Registration was a Success!";
} else {
    echo "Something went wrong please try again!";
}

?>
<br>
<a href="login_user.php">Login</a>

</div>