<?php

require_once 'vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'vendor/autoload.php';

$client_id = '1071704055523-dmghgim6hlvahfhip5afi5sks9q4917d.apps.googleusercontent.com';
$client_secret = 'Emn-Ei79SDZsuvTOPhCSUiXm';
$redirect_url = 'http://localhost:8888/JokesApp/google_login.php';

$db_username = 'root';
$db_password = 'root';
$host_name = 'localhost';
$db_name = 'test';

$client = new Google_Client();
$client->setClientID($client_id);
$client->setClientSecret($client_secret);
$client->getRedirectUri($redirect_url);
$client->addScope("email");
$client->addScope("profile");
$service = new Google_Service_Oauth2($client);

if(isset($_GET['logout'])){
    $client->revokeToken($_SESSION['access_token']);
    session_destroy();
    header('index.phh');
}

if(isset($_GET['code'])){
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
    exit;
}

if(isset($_SESSION['access_token']) && $_SESSION['access_token']){
    $client->setAccessToken($_SESSION['access_token']);
    
} else {
    $authURL = $client->createAuthUrl();
}

echo("<div>style='margin: 20px'");
if(isset($authURL)) {
    echo("<div>align='center'");
    echo("<h3>Login</h3>");
    echo("<div>You will need a Google Account to Sign in</div>");
    echo("<a class='login' href='" . $authURL . "'> Login Here</a>");
    echo("</div>");
} else {
    $user = $service->userinfo->get();
}

$mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);

if(mysqli_connect_error()) {
    die ("Connection Error: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

$results = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id = $user->id");
$user_count = $results->fetch_object()->usercount;

echo '<img scr="' . $user->picture .'" style="float: right; margin-top: 33px;" />';

if($user_count) {
    echo 'Welcome back ' . $user->name . '! [<a href="' . $redirect_url . '">Logout</a>]';

} else {
    echo 'Hi ' . $user->name . ', Thank you for Registering! [<a href="' . $redirect_url . '?logout=1">Logout</a>]';
    $statment = $mysqli->prepare("INSERT INTO `google_users` (`id`, `google_id`, `google_name`, `google_email`, `google_link`, `google_picture_link`) VALUES (NULL, ?, ?, ?, ?, ?)");
    $statment->bind_param("issss", $user->id, $user->name, $user->email, $user->link, $user->picture);
    $statment->execute();
    echo $mysqli->error;
}

echo '<p>Data about this user. <ul><lr>Username: ' . $user->name . '</li> <li>User ID: ' . $user->id . '</li> <li> Email: ' . $user->email . '</li></ul></p>';

$_SESSION['username'] = $user->name;
$_SESSION['userid'] = $user->id;
$_SESSION['usermail'] = $user->email;

echo "</div>";





