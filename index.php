<?php
/* Including fetchData.php file. */
require 'fetchData.php';

/** Calling getData function and storing data into dataObjArr. */
$dataObjArr = getData();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
    <div class="box">

            <div class="box2">
            <!-- Displaying image. -->
            <img src="<?php echo $dataObjArr[count($dataObjArr)-1]->getImage(); ?>" alt="">
            </div>

            <div class="box1">
                <!-- Displaying Title.  -->
                <h2> <?php echo $dataObjArr[count($dataObjArr)-1]->getTitle(); ?></h2>

                <!-- Displaying Service links. -->
                <?php echo $dataObjArr[0]->getService(); ?> </p>

                <!-- Displaying icons. -->
                <?php for($j=0; $j<count($dataObjArr[count($dataObjArr)-1]->getIcon()); $j++) {?>
                <img class="icon" src="<?php echo $dataObjArr[count($dataObjArr)-1]->getIcon()[$j]; ?>" alt="">
                <?php  } ?> <br><br><br>

                <!-- Explore Button.  -->
                <a href="<?php echo $dataObjArr[count($dataObjArr)-1]->getAlias(); ?>" class = "btn" >EXPLORE MORE</a>
            </div>
            
        </div>
        <!-- For Loop for iterating through dataObjArr Array. -->
        <?php for ($i = 0; $i < count($dataObjArr)-1; $i++) { 
            // Checking for even and odd to display images and data.
            if($i % 2 == 0 ) { ?>
                <div class="box">
                <div class="box1">

                    <!-- Displaying Title.  -->
                    <h2> <?php echo $dataObjArr[$i]->getTitle(); ?></h2>

                    <!-- Displaying Service links. -->
                    <?php echo $dataObjArr[0]->getService(); ?> </p>

                    <!-- Displaying icons. -->
                    <?php for($j=0; $j<count($dataObjArr[$i]->getIcon()); $j++) {?>
                    <img class="icon" src="<?php echo $dataObjArr[$i]->getIcon()[$j]; ?>" alt="">
                    <?php  } ?> <br><br><br>

                    <!-- Explore Button.  -->
                   <a href="<?php echo $dataObjArr[0]->getAlias(); ?>" class = "btn" >EXPLORE MORE</a>
                </div>

                <div class="box2">
                <!-- Displaying image. -->
                <img src="<?php echo $dataObjArr[$i]->getImage(); ?>" alt="">
                </div>
                </div>
            <?php } 
            else { ?>
                <div class="box">

                <div class="box2">
                <!-- Displaying image. -->
                <img src="<?php echo $dataObjArr[$i]->getImage(); ?>" alt="">
                </div>

                <div class="box1">
                    <!-- Displaying Title.  -->
                    <h2> <?php echo $dataObjArr[$i]->getTitle(); ?></h2>

                    <!-- Displaying Service links. -->
                    <?php echo $dataObjArr[0]->getService(); ?> </p>

                    <!-- Displaying icons. -->
                    <?php for($j=0; $j<count($dataObjArr[$i]->getIcon()); $j++) {?>
                    <img class="icon" src="<?php echo $dataObjArr[$i]->getIcon()[$j]; ?>" alt="">
                    <?php  } ?> <br> <br><br>
                    <a href="<?php echo $dataObjArr[0]->getAlias(); ?>" class = "btn" >EXPLORE MORE</a>
                </div>
            </div>
            <?php
            }
         } ?>

    </div>



</body>

</html>