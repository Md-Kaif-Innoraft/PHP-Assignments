<?php

// Checking for session is logged or not.
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
header("location: ../index.php");
exit;
}

//Including formValidator.php file.
require 'FormValidator.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 1</title>
</head>

<body>
  <div class="container">
    <div class="box">
      <!-- form starts here -->
      <h2 class="text-center">PHP Assignment 1</h2><br><br>
      <form id="form" method="post" action="?q=1">
        <label for="fName"><span class="error">* </span> First Name : </label> <br>
        <input type="text" name="fName" id="fName" required maxlength="20" value="<?php echo $_POST['fName']; ?>" pattern="[a-zA-Z ]*">
        <span class="error" id="ferror"><?php echo $formValidator->getFirstNameErr(); ?> <br><br></span>

        <label for="lName"> <span class="error">* </span> Last Name : </label> <br>
        <input type="text" id="lName" name="lName" required maxlength="20" value="<?php echo $_POST['lName']; ?>" pattern="[a-zA-Z ]*"> <br>
        <span class="error" id="lerror"><?php echo $formValidator->getLastNameErr(); ?> <br><br></span>

        <button class="btn">Submit </button> <br> <br> <br>

        <label for="fullName">Full Name:</label> <br>
        <input type="text" id="fullName" name="fullName" disabled value="<?php echo $formValidator->getFullName(); ?>">
        <span class="error"><?php echo $formValidator->getFullNameError(); ?></span> <br><br>
      </form>
      <!-- form ends here -->
      <!-- Printing full name with greeting. -->
      <?php echo $formValidator->getMessage(); ?> <br>
      <div class="img-sec">
        <?php include "./buttons.php" ?>
      </div>
    </div>
  </div>
  <script src="./Assignment1/index.js"></script>
</body>
</html>
