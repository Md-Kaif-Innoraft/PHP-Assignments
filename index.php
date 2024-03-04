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
                <input type="text" name="fname" id="fname">
                <label for="fname"> <span class="error">* </span> Last Name : </label> <br>
                <input type="text" id="lname" name="lname"> <br>
                <label for="number"><span class="error">* </span> Phone number : </label> <br>
                <input type="text" id="number" name="number"> <br>
                <label for="email"><span class="error">* </span> Email : </label> <br>
                <input type="text" id="email" name="email"> <br>
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