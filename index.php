<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 5</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- PHP Logic starts here to fetch info  -->
    <?php

    // Creating variables to store info
    $fnameErr = $lnameErr = $num = "";
    $fname = $lname = $num_Err = $email_success = "";
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

        if (empty($_POST['number'])) {
            $numErr = "* Phone number is requited.";
        } else {
            $num = $_POST['number'];
            if (!preg_match("/[0-9]/", $num)) {
                $numErr = "* Only numbers are allowed.";
            } else if (strlen($num) < 10) {
                $numErr = "* Please Enter 10 digit number";
            } else {
                $num = "+91 {$num}";
            }


        }

        if (empty($_POST['email'])) {
            $emailErr = "* Email is required";
        } else {
            $email = check_input($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = "";
            $emailErr = "* Invalid email format";
            } else{
                $email_success = "email validated successfully.";
            }
        } 


        if (!empty($_FILES['image']['name'])) {
            $img_temp_name = $_FILES['image']['tmp_name'];
            $img_name = $_FILES['image']['name'];
            move_uploaded_file($img_temp_name, "uploads/$img_name");
        }

        $marks_arr = explode("\n", $_POST["sub"]);
        //Creating an object 
    
        $user = new User($fname, $lname);

    }

    //  function to modify user input data
    function check_input($data)
    {
        $data = trim($data); //removes extra spaces from the begning and end.
        $data = stripslashes($data);  // removes backslashes 
        $data = htmlspecialchars($data); // convert special characters to HTML entities
        return $data;
    }

    //creating a class named User
    
    class User
    {

        private $fname;
        private $lname;

        function __construct($fname, $lname)
        {
            $this->fname = $fname;
            $this->lname = $lname;

        }

        function get_Fname()
        {
            return $this->fname;
        }

        function get_Lname()
        {
            return $this->lname;
        }

    }




    ?>
    <div class="container">
        <div class="box">
            <!-- form starts here -->
            <h2 class="text-center">PHP Assignment 5</h2><br><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                enctype="multipart/form-data">
                <label for="fname"><span class="error">* </span> First Name : </label> <br>
                <input type="text" name="fname" id="fname">
                <span class="error">
                    <?php echo " $fnameErr <br><br>"; ?>
                </span>
                <label for="fname"> <span class="error">* </span> Last Name : </label> <br>
                <input type="text" id="lname" name="lname"> <br>
                <span class="error">
                    <?php echo "$lnameErr <br><br>"; ?>
                </span>
                <label for="number"><span class="error">* </span> Phone number : </label> <br>
                <input type="text" id="number" name="number"> <br>
                <span class="error">
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
                Image :
                <input class="file" type="file" name="image"><br><br>
                <button class="btn">Submit</button> <br> <br> <br>
                <label for="full_name">Full Name:</label> <br>
                <input type="text" id="full_name" name="full_name" disabled value="<?php if (!(empty($fname) || empty($lname))) {
                    echo "$fname $lname";
                }
                ?>"> <br><br>
            </form>
            <!-- form ends here -->

            <!-- print full name -->

            <div class="img-sec">
                <?php
                if (!(empty($fname) || empty($lname))) {
                    echo "<p>Hello, {$user->get_Fname()} {$user->get_Lname()} .<br> <br></p>";
                    echo "Your Phone Number is: $num <br><br>";
                    echo "Your Email is: $email <br><br>";
                    if (!empty($img_name)) {
                        echo "<img src = 'uploads/$img_name' height= 250px >";
                        echo "<br>";
                        echo $img_name;
                        echo "<br><br>";
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
                        $subject = trim($parts[0]);
                        $marks = trim($parts[1]);
                        echo "<tr>
                        <td>$i</td>
                        <td>$subject</td>
                        <td>$marks</td>
                        </tr>";
                        $i++;
                    }
                    echo "</table>";
                }

                ?>
            </div>
        </div>
    </div>
</body>

</html>