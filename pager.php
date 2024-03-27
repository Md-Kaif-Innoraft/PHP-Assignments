<?php

/* Starting the session. */
session_start();

//Checking if the user is loggedin or not if user in not loggedin redirecting to login page.
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
  header("location: index.php");
  exit;
}

// Checking for url rewriting and directing on the question page.
if (is_numeric($_GET['q']) && ($_GET['q']>=1 && $_GET['q']<=6)) {
  $q = $_GET['q'];
}
else {
  // Default to question 1 if no question number is provided
  $q = 1;
}

include "./Assignment$q/index.php";
