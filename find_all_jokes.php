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

<?php
    include("db_connection.php");

    //Check to see if the connection was successful
    if($mysqli->connect_errno){
        echo "Failed Connection to MySQL: " . $mysqli->connect_errno . "\n\t" . $mysqli->connect_error; 
    }

    echo "<legend>List of all Jokes</legend>";
    echo '<div id="accordion">';

    //Gettting data from the database
    $sql_statment = "SELECT Question, Answer, user_table.Username FROM Jokes_Table JOIN user_table on user_table.ID = jokes_table.User_ID";
    $rows = $mysqli->query($sql_statment);

    if($rows->num_rows > 0){
        while($row = $rows->fetch_assoc()){
            $safe_question = htmlspecialchars($row["Question"]);
            $safe_answer = htmlspecialchars($row["Answer"]);
            echo "<h3>" . $safe_question . "</h3>";
            echo "<p>" . $safe_answer . "<br>Submitted by User: " . $row['Username'] . "</p>";
        }
    } else {
        echo "No results within the databse!!";
    }

    //Closes connection
    $mysqli->close();

?>
</div>