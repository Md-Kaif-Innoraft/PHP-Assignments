<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 2</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- PHP Logic starts here to fetch info  -->
    <?php

    /* Include the User class file. */
    require_once 'user.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fullnameError = "* Invalid Input, You can't enter any value in Full Name.";

        /*  Function to remove extra spaces, backslashes and convert special characters to HTML entites form user input data. */
        function checkInput ($data) {
            //Removes extra spaces from the begning and end.
            $data = trim($data);
            // Removes backslashes. 
            $data = stripslashes($data);
            // convert special characters to HTML entities.
            $data = htmlspecialchars($data);
            return $data;
        }

        /* Validating user inputs. */
        function validateName($name, &$error, $fieldName) {
            if (empty($name)) {
                $error = "* $fieldName Name is required";
                return "";
            } 
            else {
                $name = checkInput($name);
                if (!preg_match("/^[a-zA-Z-\s' ]*$/", $name)) {
                    $error = "* Only letters and white space allowed";
                    return "";
                } 
                else if (empty($name)) {
                    $error = "* Empty, Please enter valid $fieldName Name.";
                    return "";
                } 
                else {
                    return $name;
                }
            }
        }

        // Calling ValidatName function to validate name and store in variable,
        $fname = validateName($_POST["fname"], $fnameErr, "First");
        $lname = validateName($_POST["lname"], $lnameErr, "Last");

        if (!empty($_FILES['image']['name'])) {
            $img_temp_name = $_FILES['image']['tmp_name'];
            $img_name = $_FILES['image']['name'];
            move_uploaded_file($img_temp_name, "uploads/$img_name");
        }

        //Creating an object 
        $user = new User($fname, $lname);

    }
    
    ?>

    <div class="container">
        <div class="box">

            <!-- form starts here -->
            <h2 class="text-center">PHP Assignment 1</h2><br><br>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                <label for="fname"><span class="error">* </span> First Name : </label> <br>
                <input type="text" name="fname" id="fname" required maxlength="20"
                    value="<?php echo $_POST['fname']; ?>">
                <span class="error">
                    <?php echo " $fnameErr <br><br>"; ?>
                </span>

                <label for="fname"> <span class="error">* </span> Last Name : </label> <br>
                <input type="text" id="lname" name="lname" required maxlength="20"
                    value="<?php echo $_POST['lname']; ?>"> <br>
                <span class="error">
                    <?php echo "$lnameErr <br><br>"; ?>
                </span>
                <label for="image">Image :</label> <br>
                <input class="file" type="file" name="image"><br><br>

                <button class="btn">Submit</button> <br> <br> <br>

                <label for="full_name">Full Name:</label> <br>
                <input type="text" id="fullName" name="fullName" disabled value="<?php if (!empty($fname) && !empty($lname)) {
                    echo "$fname $lname";
                } ?>">
                <span class="error">
                    <?php if (!empty($_POST['fullName'])) {
                        echo $fullnameError;
                    } ?>
                </span>

                <br><br>
            </form>
            <!-- Form ends here. -->

            <!-- Print full name. -->
            <div class="img-sec">
                <?php
                if (!(empty($fname) || empty($lname))) { ?>
                    <p>Hello, <?php echo "{$user->get_Fname()} {$user->get_Lname()}"; ?> .<br> <br></p>
                   <?php if (!empty($img_name)) {
                        echo "<img src = 'uploads/$img_name' height= 250px >";
                        echo "<br>";
                        echo $img_name;
                    }
                } 
                ?>
            </div>
        </div>
    </div>
</body>

</html>