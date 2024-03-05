<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 6</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="box">
            <!-- form starts here -->

            <h2 class="text-center">PHP Assignment 6</h2><br><br>
            <form method="post" action="formpdf.php"enctype="multipart/form-data">
                <label for="fname"><span class="error">* </span> First Name : </label> <br>
                <input type="text" name="fname" id="fname" required maxlength = "20" pattern="[A-Za-z ]*">

                <label for="fname"> <span class="error">* </span> Last Name : </label> <br>
                <input type="text" id="lname" name="lname" required maxlength = "20" pattern="[A-Za-z ]*"> <br>

                <label for="number"><span class="error">* </span> Phone number : </label> <br>
                <input type="text" id="number" name="number" required maxlength = "10" pattern="[0-9]*"> <br>

                <label for="email"><span class="error">* </span> Email : </label> <br>
                <input type="email" id="email" name="email" required> <br>

                <label for="sub">Subjects and Marks : ( Format: English|80 )</label>
                <textarea name="sub" id="sub" rows="3"></textarea>
                Image :
                <input class="file" type="file" name="image"><br><br>
                <input type=submit class="btn" name = "submit" value="submit"> <br> <br> <br>
            </form>
            </div>
        </div>
</body>

</html>