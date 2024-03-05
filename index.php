<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- PHP Logic starts here to fetch info  -->

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fullnameError = "* Invalid Input, You can't enter any value in Full Name.";

        /*  Function to remove extra spaces, backslashes and convert special characters to HTML entites form user input data. */
        function checkInput($data) {
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
        
    }

    ?>

    <div class="container">
        <div class="box">

            <!-- form starts here -->
            <h2 class="text-center">PHP Assignment 1</h2><br><br>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                <label for="fname"><span class="error">* </span> First Name : </label> <br>
                <input type="text" name="fname" id="fname" required maxlength="20" value = "<?php echo $_POST['fname']; ?>" >
                <span class="error">
                    <?php echo " $fnameErr <br><br>"; ?>
                </span>

                <label for="fname"> <span class="error">* </span> Last Name : </label> <br>
                <input type="text" id="lname" name="lname" required maxlength="20" value = "<?php echo $_POST['lname']; ?>"> <br>
                <span class="error">
                    <?php echo "$lnameErr <br><br>"; ?>
                </span>

                <button class="btn">Submit</button> <br> <br> <br>

                <label for="full_name">Full Name:</label> <br>
                <input type = "text" id = "fullName" name = "fullName" disabled value = "<?php if (!empty($fname) && !empty($lname)) {
                    echo "$fname $lname";
                } ?>">
                <span class="error">
                    <?php if(!empty($_POST['fullName'])){
                        echo $fullnameError;
                    } ?>
                </span>

                <br><br>
            </form>
            <!-- form ends here -->
            
            <!-- Printing full name with greeting. -->
            <?php
            if (!empty($fname) && !empty($lname)) { ?>
                <p>Hello, <?php echo "$fname $lname"; ?>.</p>
            <?php }
            ?>

        </div>
    </div>
</body>

</html>