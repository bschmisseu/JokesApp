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

<?php
    include("db_connection.php");

    $keyword = $_GET["keyword"];
    $keywordAny = "%" . addslashes($keyword) . "%";

    //Searching Function
    $sql_statment = $mysqli->prepare("SELECT Question, Answer, Username FROM Jokes_Table JOIN user_table on user_table.ID = jokes_table.User_ID WHERE jokes_table.Question LIKE ?");
    $sql_statment->bind_param("s", $keywordAny);
    
    $sql_statment->execute();
    $sql_statment->store_result();
    
    $sql_statment->bind_result($question, $answer, $username);

    echo "<legend>Searching for Jokes with the word $keyword</legend>";
    echo '<div id="accordion">';

    if($sql_statment->num_rows > 0){
        while($sql_statment->fetch()){
            $safe_question = htmlspecialchars($question);
            $safe_answer = htmlspecialchars($answer);
            echo "<h3>" . $safe_question . "</h3>";
            echo "<p>" . $safe_answer . "<br>Submitted by User: " . $username . "</p>";
        }
    } else {
        echo "No results within the database!!";
    }

    //Closes connection
    $mysqli->close();

?>
</div>