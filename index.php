<html>
	<head>
		<title>PHP Jokes App</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div style="width: 100%; text-align: center" >
			<h1>Jokes Application</h1>
			<?php
			     session_start();
			     
			     if(!$_SESSION['username']) {
			         echo '<a href="login_user.php">Login</a> ';
			         echo '<a href="register_user.php">Register</a>';
			     } else {
			         echo '<a href="logout.php">Logout</a>';
			     }
			?>
		</div>

		<form class="form-horizontal" action="search_jokes.php" method="GET">
		<fieldset>

		<!-- Form Name -->
		<legend>Search for a joke</legend>

		<!-- Search input-->
		<div class="form-group">
		<label class="col-md-4 control-label" for="keyword">Search</label>
		<div class="col-md-5">
			<input id="keyword" name="keyword" type="search" placeholder="e.g. Chicken" class="form-control input-md">
			<p class="help-block">Please enter a keyword in a joke</p>
		</div>
		</div>

		<!-- Button -->
		<div class="form-group">
		<label class="col-md-4 control-label" for="search_submit"></label>
		<div class="col-md-4">
			<button id="search_submit" name="search_submit" class="btn btn-primary">Search</button>
		</div>
		</div>

		</fieldset>
		</form>

		<form class="form-horizontal" action="add_joke.php" method="POST">
		<fieldset>

		<!-- Form Name -->
		<legend>Add a Joke</legend>

		<!-- Text input-->
		<div class="form-group">
		<label class="col-md-4 control-label" for="question">Question</label>  
		<div class="col-md-5">
		<input id="question" name="question" type="text" placeholder="e.g. Why did the chicken cross the road?" class="form-control input-md">
		<span class="help-block">Enter the question for the joke</span>  
		</div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		<label class="col-md-4 control-label" for="answer">Answer</label>  
		<div class="col-md-5">
		<input id="answer" name="answer" type="text" placeholder="e.g. To get to the other side?" class="form-control input-md">
		<span class="help-block">Enter the answer for the joke</span>  
		</div>
		</div>

		<!-- Button -->
		<div class="form-group">
		<label class="col-md-4 control-label" for="add_submit"></label>
		<div class="col-md-4">
			<button id="add_submit" name="add_submit" class="btn btn-primary">Add Joke</button>
		</div>
		</div>

		</fieldset>
		</form>
		
		<?php
			include("find_all_jokes.php");
			echo  "<hr>";
		?>
	</body>
</html>