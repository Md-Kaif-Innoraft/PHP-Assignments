<?php
  // Including formValidator.php file.
  require 'FormValidator.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 3</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="box">
      <!-- form starts here -->
      <h2 class="text-center">PHP Assignment 3</h2><br><br>
      <form id="form" onsubmit = "return validate()" method="post" action="?q=3" enctype="multipart/form-data">
        <label for="fName"><span class="error">* </span> First Name : </label> <br>
        <input type="text" name="fName" id="fName" required pattern="[a-zA-Z ]*" maxlength="20" value="<?php echo $_POST['fName']; ?>" >
        <span class="error" id="ferror"><?php echo $formValidator->getFirstNameErr(); ?> <br><br></span>

        <label for="lName"> <span class="error">* </span> Last Name : </label> <br>
        <input type="text" id="lName" name="lName" required pattern="[a-zA-Z ]*" maxlength="20" value="<?php echo $_POST['lName']; ?>" > <br>
        <span class="error" id="lerror"><?php echo $formValidator->getLastNameErr(); ?> <br><br></span>

        <label for="sub">Subjects and Marks : ( Format: English|80)</label>
        <textarea required name="sub" id="sub" rows="3"></textarea>
        <span class="error" id="serror"><?php echo $formValidator->getTableErr(); ?><br><br></span>

        <label for="image">Image :</label> <br>
        <input class="file" type="file" id ="image" name="image" accept="image/png, image/gif, image/jpeg"><br><br>

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
            <?php if (!empty($formValidator->getImgName())) { ?>
            <img src = '../uploads/<?php echo $formValidator->getImgName(); ?>' height= 250px > <br>
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
        <?php include "./buttons.php" ?>
      </div>
    </div>
  </div>
  <script src="index.js"></script>
</body>
</html>
