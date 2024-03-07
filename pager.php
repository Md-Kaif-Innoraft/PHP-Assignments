<?php

    /* Starting the session. */
    session_start();

    //Checking if the user is loggedin or not if user in not loggedin redirecting to login page.
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
        header("location: index.php");
        exit;
    }
    
    // Checking for url rewriting and directing on the question page.
    if (isset($_GET['q']) && is_numeric($_GET['q'])) {
      $question_number = $_GET['q'];
    }
    else {
      // Default to question 1 if no question number is provided
      $question_number = 1;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="box">

        <h2 class="text-center">Hello, <?php echo $_SESSION['username']; ?> . </h2><br><br>
        <?php include ('q'.$question_number.'php'); ?>
        <br>
        <a href="logout.php"><button class="btn">Submit</button></a>
        </div>
    </div>
</body>
</html>