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

    // Creating variables to store info
    $fnameErr = $lnameErr = "";
    $fname = $lname = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["fname"])) {
            $fnameErr = "* First Name is required";
        } else {
            $fname = check_input($_POST["fname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
                $fname = "";
                $fnameErr = "* Only letters and white space allowed";
            }
        }
        if (empty($_POST["lname"])) {
            $lnameErr = "* Last Name is required";
        } else {
            $lname = check_input($_POST["lname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
                $lname = "";
                $lnameErr = "* Only letters and white space allowed";
            }
        }

    }

    //  function to modify user input data
    function check_input($data)
    {
        $data = trim($data); //removes extra spaces from the begning and end.
        $data = stripslashes($data);  // removes backslashes 
        $data = htmlspecialchars($data); // convert special characters to HTML entities
        return $data;
    }
    ?>
    <div class="container">
        <div class="box">
            <!-- form starts here -->
            <h2 class="text-center">PHP Assignment 1</h2><br><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="fname"><span class="error">* </span> First Name : </label> <br>
                <input type="text" name="fname" id="fname"> 
                <span class="error" ><?php echo " $fnameErr <br><br>"; ?> </span>
                <label for="fname"> <span class="error">* </span> Last Name : </label> <br>
                <input type="text" id="lname" name="lname"> <br>
                <span class="error"><?php echo "$lnameErr <br><br>"; ?> </span>
                <button class="btn">Submit</button> <br> <br> <br>
                <label for="full_name">Full Name:</label> <br>
                <input type="text" id="full_name" name="full_name" disabled value = "<?php if(!(empty($fname)|| empty($lname))){
                    echo "$fname $lname";
                }
                ?>"> <br><br>
            </form>
            <!-- form ends here -->

            <!-- print full name -->

            <?php  
                if(!(empty($fname)|| empty($lname))){
                    echo "<p>Hello, $fname $lname .</p>";
                }
                ?>
        </div>
    </div>
</body>

</html>