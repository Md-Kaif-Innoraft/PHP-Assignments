<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 4</title>
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

        if (empty($_POST['number'])){
            $numErr = "* Phone number is required.";
        } 
        else {
            $num = $_POST['number'];
            if(!preg_match("/[0-9]/" , $num)){
                $numErr = "* Only numbers are allowed.";
            } 
            else if (strlen($num) != 10){
                $numErr = "* Please Enter 10 digit number";
            } 
            else{
                $num = "+91 {$num}";
            }
        }

        // Calling ValidatName function to validate name and store in variable.
        $fname = validateName($_POST["fname"], $fnameErr, "First");
        $lname = validateName($_POST["lname"], $lnameErr, "Last");

        if (!empty($_FILES['image']['name'])) {
            $img_temp_name = $_FILES['image']['tmp_name'];
            $img_name = $_FILES['image']['name'];
            move_uploaded_file($img_temp_name, "uploads/$img_name");
        }

        $marks_arr = explode("\n", $_POST["sub"]);
        //Creating an object 
        $user = new User($fname, $lname);

    }

    ?>

    <div class="container">
        <div class="box">

            <!-- form starts here -->
            <h2 class="text-center">PHP Assignment 4</h2><br><br>

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

                <label for="number"> Phone number : </label> <br>
                <input type="text" id="number" maxlength = "10" name="number" value="<?php echo $_POST['number']; ?>"> <br>
                <span class="error">
                    <?php echo "$numErr <br> <br>"; ?>
                </span>

                <label for="sub">Subjects and Marks : ( Format: English|80 )</label>
                <textarea name="sub" id="sub" rows="3"></textarea>
                <span class="error">
                    <?php echo $marksErr; ?><br><br>
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
                    <p>Your Phone Number is: </p> <?php echo $num ; ?> <br><br>
                   <?php if (!empty($img_name)) {
                        echo "<img src = 'uploads/$img_name' height= 250px >";
                        echo "<br>";
                        echo $img_name;
                    }
                    echo "<h2>Marks : </h2>";
                    echo "<table class= 'table' border='1'>";
                    echo "<tr>
                        <th>S No.</th>
                        <th>Subject</th>
                        <th>Marks</th>
                         </tr>";
                    $i = 1;
                    foreach ($marks_arr as $line) {
                        $parts = explode("|", $line);
                        if (count($parts) == 2){
                            if(is_numeric($parts[0])){
                                $subject = trim($parts[1]);
                                $marks = trim($parts[0]);
                            } else{
                                $subject = trim($parts[0]);
                                $marks = trim($parts[1]);
                            }
                        echo "<tr>
                        <td>$i</td>
                        <td>$subject</td>
                        <td>$marks</td>
                        </tr>";
                        $i++;
                        }
                        else{
                            $marksErr = "Invalid Marks";
                        }
                    }
                    echo "</table>";
                } 
                ?>
            </div>
        </div>
    </div>
</body>

</html>