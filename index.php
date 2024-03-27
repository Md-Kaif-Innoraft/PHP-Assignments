<?php
/* Starting Session. */
session_start();

// Include vendor's autoload file.
require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Set user name.
$validUser = $_ENV['USERNAME'];
// Set Password.
$validPass = $_ENV['PASSWORD'];
// Variable for error if user fills wrong username or password.
$loginErr = "";

// Checking if the user is loggedin or not if user in loggedin redirecting to pager page.
if (isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == true) {
  header("location: pager.php");
  exit;
}

// Checking form submitted method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Storing username and password from the form.
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Matching username and password.
  if (($validUser == $username) && ($validPass == $password)) {
    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = $username;
    header("location: pager.php");
  }
  else {
    $loginErr = "* Invalid Credentials.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <div class="container">
    <div class="box">
      <!-- form starts here -->
      <h2 class="text-center">Login</h2><br><br>

      <form id="form" method="post" action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="username"><span class="error">* </span> Username : </label> <br>
        <input type="text" name="username" id="username" required maxlength="20" value="<?php echo $_POST['username']; ?>" pattern="[a-zA-Z 0-9]*">

        <label for="password"> <span class="error">* </span> Password : </label> <br>
        <input type="password" id="password" name="password" required maxlength="20" value="<?php echo $_POST['password']; ?>" pattern="[a-zA-Z 0-9]*"> <br>

        <a href="logout.php"><button class="btn">Login</button></a>
        <span class = "error"> <?php echo $loginErr ; ?> </span>
      </form>
    </div>
  </div>
</body>
</html>
