<?php
  //Including formValidator.php file.
  require 'formValidator.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 5</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="box">
      <!-- form starts here -->
      <h2 class="text-center">PHP Assignment 5</h2><br><br>
      <form id="form" onsubmit = "return validate()" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <label for="fName"><span class="error">* </span> First Name : </label> <br>
        <input type="text" name="fName" id="fName" required maxlength="20" value="<?php echo $_POST['fName']; ?>" pattern="[a-zA-Z ]*">
        <span class="error" id="ferror"><?php echo $formValidator->getFirstNameErr(); ?> <br><br></span>

        <label for="lName"> <span class="error">* </span> Last Name : </label> <br>
        <input type="text" id="lName" name="lName" required maxlength="20" value="<?php echo $_POST['lName']; ?>" pattern="[a-zA-Z ]*"> <br>
        <span class="error" id="lerror"><?php echo $formValidator->getLastNameErr(); ?> <br><br></span>

        <label for="number"> Phone number : </label> <br><input type="text" id="number" maxlength="10" name="number" value="<?php echo $_POST['number']; ?>" required pattern="[0-9]*"> <br>
        <span class="error" id="nerror"><?php echo $formValidator->getNumErr(); ?><br> <br></span>

        <label for="email"><span class="error">* </span> Email : <span class="success"><?php echo $formValidator->getEmailSuccess(); ?></span></label> <br>
        <input type="text" id="email" name="email"value="<?php echo $_POST['email']; ?>" required> <br>
        <span class="error" id="emailErr"><?php echo $formValidator->getEmailErr(); ?> <br> <br></span>

        <label for="sub">Subjects and Marks : ( Format: English|80)</label>
        <textarea required name="sub" id="sub" rows="3"></textarea>
        <span class="error" id="serror"><?php echo $formValidator->getTableErr(); ?><br><br></span>

        <label for="image">Image :</label> <br>
        <input class="file" type="file" name="image" accept="image/png, image/gif, image/jpeg"><br><br>

        <button class="btn">Submit </button> <br> <br> <br>

        <label for="fullName">Full Name:</label> <br>
        <input type="text" id="fullName" name="fullName" disabled value="<?php echo $formValidator->getFullName(); ?>">
        <span class="error"><?php echo $formValidator->getFullNameError(); ?></span> <br><br>
      </form>
      <!-- form ends here -->
      <!-- Printing full name with greeting And Image. -->
      <div class="img-sec">
          <?php
            if (!empty($formValidator->getFullName())) {
              echo $formValidator->getMessage(); ?> <br> <br>
              <?php echo $formValidator->getNumMsg(); ?><br>
              <?php echo $formValidator->getEmailMsg(); ?><br> <br>
              <?php if (!empty($formValidator->getImgName())) { ?>
              <img src = 'uploads/<?php echo $formValidator->getImgName(); ?>' height= 250px > <br>
              <?php echo $formValidator->getImgName();
              }
              if (empty($formValidator->getTableErr())) { ?>
                <h2>Marks</h2>
                <table class = 'table' border = '1'>
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>MArks</th>
                    </tr>
                  </thead>
                  <?php foreach ($formValidator->getMarksTable() as $subject => $marks) { ?>
                    <tr>
                      <td><?php echo $subject; ?></td>
                      <td><?php echo $marks; ?></td>
                    </tr>
                  <?php } ?>
                </table>
              <?php
              }
            }
          ?>
      </div>
    </div>
  </div>
  <script src="index.js"></script>
</body>
</html>
