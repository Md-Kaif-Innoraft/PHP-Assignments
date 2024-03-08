<?php
 
//Including autoload.php .
require_once('./vendor/autoload.php');
use Fpdf\Fpdf;

//check if form is submitted
if (!empty($_POST['submit'])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST['email'];
    $num = $_POST['number'];
    $num = "+91 ".$num;

    if (!empty($_FILES['image']['name'])) {
        $img_temp_name = $_FILES['image']['tmp_name'];
        $img_name = $_FILES['image']['name'];
        move_uploaded_file($img_temp_name, "uploads/$img_name");
    }

   //Full name from first name and last name.
    $fullname = $fname . " " . $lname;

    //Create new object from Fpdf .
    $pdf = new Fpdf();
 
    //Creating a new page. 
    $pdf->AddPage();
    
    //Set font of the page.
    $pdf->SetFont("Arial", "", 12);

    //Display image on pdf.
    if (!empty($img_name)) {
        $pdf->Image("uploads/$img_name", 150, 25, 50);
    }

    //Creating cells of pdf.
    $pdf->Cell(0, 14, "Registration Details", 1, 1, 'C');

    $pdf->Cell(40, 17, "Full Name: ", 1, 0);
    $pdf->Cell(98, 17, $fullname, 1, 1);

    $pdf->Cell(40, 17, "Email: ", 1, 0);
    $pdf->Cell(98, 17, $email, 1, 1);

    $pdf->Cell(40, 17, "Phone Number: ", 1, 0);
    $pdf->Cell(98, 17, $num, 1, 1);

    $marks_arr = explode("\n", $_POST["sub"]);

    //Checking if Marks are entered or not.
    if(!empty($_POST["sub"])){
    $pdf->Cell(0, 14, "Marks", 1, 1, 'C');
    
    $pdf->cell(20, 14, "SNo.", 1, 0, 'C');
    $pdf->cell(85, 14, "Subject", 1, 0, 'C');
    $pdf->cell(85, 14, "Marks", 1, 1, 'C');

    
    $i =0; 

    //Display marks on pdf .
    foreach ($marks_arr as $line) {
        $i++;
        $parts = explode("|", $line);
        if(count($parts)==2){
            $subject = trim($parts[0]);
            $marks = trim($parts[1]);
            if(is_numeric($parts[1]) && !is_numeric($parts[0])){
                $pdf->cell(20, 14, $i, 1, 0, 'C');
                $pdf->cell(85, 14, $subject, 1, 0, 'C');
                $pdf->cell(85, 14, $marks, 1, 1, 'C');
            }
            else if(is_numeric($parts[0]) && !is_numeric($parts[1])){
                $pdf->cell(20, 14, $i, 1, 0, 'C');
                $pdf->cell(85, 14, $marks, 1, 0, 'C');
                $pdf->cell(85, 14, $subject, 1, 1, 'C');
            }
            else{
                $pdf->Cell(0, 14, "Inavalid Marks Entered.", 1, 1, 'C');
            }
       
        }
        else{
            $pdf->Cell(0, 14, "Inavalid Marks Entered.", 1, 1, 'C');
        }
    }
    }

    //Output as pdf.
    
    $pdf->Output();
}


?>