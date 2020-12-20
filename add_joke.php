<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#accordion" ).accordion();
        } );
    </script>
</head>

<div style="width: 100%; text-align: center" >
    <h1>Jokes Application</h1>
</div>

<legend>Adding the Joke!</legend>

<?php

session_start();

if(!$_SESSION['username']){
    echo '<div style="text-align: center">';
    echo "Your must be logged in inorder to add a joke!<br>";
    echo '<a href="login_user.php">Login Page</a></div>';
    exit;
}

    //Take out all comments when secureing website for sql injetion
    include("db_connection.php");

    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $userid = $_SESSION['userid'];

    $question = addslashes($question);
    $answer = addslashes($answer);

    $sql_statment = $mysqli->prepare("INSERT INTO `test`.`jokes_table` (`ID`, `Question`, `Answer`, `User_ID`) VALUES (NULL, ?, ?, ?);");
    $sql_statment->bind_param("ssi", $question, $answer, $userid);
    
    $sql_statment->execute();
    
    $sql_statment->close();
?>

<div id="accordion">
        <?php
            echo "<h3>" . $question . "</h3>";
            echo "<p>" . $answer ."</p>";
        ?>
</div>

<div style="width: 100%; text-align: center" >
    <a href="/JokesApp">Back to the main page</a>
</div>