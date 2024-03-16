<?php
  //Including formValidator.php file.
  require 'formValidator.php';
  //Creating formValidator object from FormValidator.
  $formValidator = new FormValidator();
  //Calling processForm() Method.
  $formValidator->processForm();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 1</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="box">
      <!-- form starts here -->
      <h2 class="text-center">PHP Assignment 1</h2><br><br>
      <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
      <?php echo $formValidator->getMessage(); ?>
    </div>
  </div>
  <script src="index.js"></script>
</body>
</html>
