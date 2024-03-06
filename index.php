<!-- PHP Logic starts here to fetch info  -->
<?php

/* Include the User class file. */
require_once 'user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    $regex = "/^[a-zA-Z-\s' ]*$/";
    $numRegex = "/^[0-9]+$/";

    /* Checking user inputs. */

    function validate($input, $preg, &$error, $fieldName) {
        if (empty($input)) {
            $error = "* $fieldName Name is required";
            return "";
        } 
        else {
            $name = checkInput($input);
            if (!preg_match($preg , $name)) {
                $error = "* Invalid Input Type.";
                return "";
            } 
            else if (empty($name)) {
                $error = "* Empty, Please enter valid $fieldName .";
                return "";
            } 
            else {
                return $input;
            }
        }
    }

    // Calling ValidatName function to validate name and store in variable.
    $fname = validate($_POST["fname"], $regex, $fnameErr, "First Name");
    $lname = validate($_POST["lname"], $regex, $lnameErr, "Last Name");
    $num = validate($_POST["number"], $numRegex, $numErr, "Phone Number");

    if (empty($_POST['email'])) {
        $emailErr = "* Email is required";
    } else {
        $email = checkInput($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = "";
        $emailErr = "* Invalid email format";
        } else{
            $email_success = "email validated successfully.";
        }
    } 

    $numMsg = "";

    if (!empty($num) && strlen($num) == 10) {
        $num = "+91 {$num}";
        $numMsg = 'Your Phone Number is: '.$num ;
    } 
    else{
        $numErr = "Invalid Phone Number";
    }

    //Storing Image file.
    if (!empty($_FILES['image']['name'])) {
        $img_temp_name = $_FILES['image']['tmp_name'];
        $img_name = $_FILES['image']['name'];
        move_uploaded_file($img_temp_name, "uploads/$img_name");
    }

    // Declearing and initializing var.
    $tableErr = false ;
    $tableErrMsg = "";

    //Checking if first name or last name is not empty.
    if (!empty($fname) && !empty($lname)) {
        //Creating an object .
        $user = new User($fname, $lname);
        $fullName = $user->getFname().' '.$user->getLname();
        $message = "Hello $fullName.";

        //checking if marks field is not emptpy.
        if (!empty($_POST['sub'])){

        $marksArray = explode("\n", $_POST["sub"]);
        $tableHead = "Marks";
        $table = "<table class = 'table' border = '1' >";
        $table .= "<tr><th>Subject</th><th>Marks</th></tr>";
        
        // Loop through each subject and marks pair.
        foreach ($marksArray as $mark) {
            // Splitting subject and marks pair
            $marks = explode("|", $mark);
            
            if(strlen($marks) == 2){
            // Adding table rows to the HTML string.
            $table .= "<tr>";
            if(is_numeric($marks[0])){
                $table .= "<td>$marks[1]</td>";
                $table .= "<td>$marks[0]</td>";
            }
            else if(is_numeric($marks[1])){
                $table .= "<td>$marks[0]</td>";
                $table .= "<td>$marks[1]</td>";
            }
            else{
                $tableErr = true;
            }
            $table .= "</tr>";
        }
        else{
            $tableErr = true;
        }

        }
        // Close the HTML table tag.
        $table .= "</table>";
    }
    else {
        $tableErr = true;
    }

    }

    //Checking if full name filed is not filled.
    if(!empty($_POST['fullName'])){
        $fullnameError = "* Invalid Input, You can't enter any value in Full Name.";
    }

    if($tableErr == true){
        $tableErrMsg = "* Invalid Marks Input.";
    }
}
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

                <label for="fname"><span class="error">* </span> First Name : </label> <br>
                <input type="text" name="fname" id="fname" maxlength="20"
                    value="<?php echo $_POST['fname']; ?>" required pattern = "[a-zA-Z ]*" >
                <span class="error" id="ferror">
                    <?php echo " $fnameErr <br><br>"; ?>
                </span>

                <label for="lname"> <span class="error">* </span> Last Name : </label> <br>
                <input type="text" id="lname" name="lname" required maxlength="20"
                    value="<?php echo $_POST['lname']; ?>" pattern = "[a-zA-Z ]*"> <br>
                <span class="error" id="lerror">
                    <?php echo "$lnameErr <br><br>"; ?>
                </span>

                <label for="number"> Phone number : </label> <br>
                <input type="text" id="number" maxlength = "10" name="number" value="<?php echo $_POST['number']; ?>" pattern = "[0-9]*"> <br>
                <span class="error" id = "nerror">
                    <?php echo "$numErr <br> <br>"; ?>
                </span>

                <label for="email"><span class="error">* </span> Email :  <span class="success">
                    <?php echo " $email_success"; ?>
                </span></label> <br>
                <input type="text" id="email" name="email"> <br>
                <span class="error">
                    <?php echo "$emailErr <br> <br>"; ?>
                </span>

                <label for="sub">Subjects and Marks : ( Format: English|80 )</label>
                <textarea name="sub" id="sub" rows="3"></textarea>
                <span class="error">
                    <?php echo $tableErrMsg; ?><br><br>
                </span>

                <label for="image">Image :</label> <br>
                <input class="file" type="file" name="image" accept="image/png, image/gif, image/jpeg"><br><br>

                <button class="btn">Submit</button> <br> <br> <br>

                <label for="full_name">Full Name:</label> <br>
                <input type="text" id="fullName" name="fullName" disabled value="<?php echo $fullName; ?>">
                <span class="error">
                    <?php echo $fullnameError; ?>
                </span>

                <br><br>
            </form>
            <!-- Form ends here. -->
        
            <!-- Print full name Greeting message and Image. -->
            <div class="img-sec">
                <?php
                if (isset($fullName)) { 
                    echo $message; ?> <br>
                    <?php echo $numMsg; ?>
                    <br> <br>
                   <?php if (!empty($img_name)) { ?>
                    <img src = 'uploads/<?php echo $img_name; ?>' height= 250px > <br>
                    <?php echo $img_name; ?>
                    <br><br>
                    <?php
                    } 
                    echo $table;
                } 
                ?>
            </div>
    </div>

    <script src="index.js"></script>
</body>
</html>