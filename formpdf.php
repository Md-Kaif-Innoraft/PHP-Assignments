<?php
require_once('./vendor/autoload.php');
use Fpdf\Fpdf;

if (!empty($_POST['submit'])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST['email'];
    $num = $_POST['number'];

    if (!empty($_FILES['image']['name'])) {
        $img_temp_name = $_FILES['image']['tmp_name'];
        $img_name = $_FILES['image']['name'];
        move_uploaded_file($img_temp_name, "uploads/$img_name");
    }


    $fullname = $fname . " " . $lname;
    $pdf = new Fpdf();

    $pdf->AddPage();
    $pdf->SetFont("Arial", "", 12);

    if (!empty($img_name)) {
        $pdf->Image("uploads/$img_name", 150, 25, 50);
    }

    $pdf->Cell(0, 14, "Registration Details", 1, 1, 'C');

    $pdf->Cell(40, 17, "Full Name: ", 1, 0);
    $pdf->Cell(98, 17, $fullname, 1, 1);

    $pdf->Cell(40, 17, "Email: ", 1, 0);
    $pdf->Cell(98, 17, $email, 1, 1);

    $pdf->Cell(40, 17, "Phone Number: ", 1, 0);
    $pdf->Cell(98, 17, $num, 1, 1);

    $pdf->Cell(0, 14, "Marks", 1, 1, 'C');
    
    $pdf->cell(20, 14, "SNo.", 1, 0, 'C');
    $pdf->cell(85, 14, "Subject", 1, 0, 'C');
    $pdf->cell(85, 14, "Marks", 1, 1, 'C');

    $marks_arr = explode("\n", $_POST["sub"]);
    $i =0;
    foreach ($marks_arr as $line) {
        $i++;
        $parts = explode("|", $line);
        $subject = trim($parts[0]);
        $marks = trim($parts[1]);
        $pdf->cell(20, 14, $i, 1, 0, 'C');
        $pdf->cell(85, 14, $subject, 1, 0, 'C');
        $pdf->cell(85, 14, $marks, 1, 1, 'C');
    }
    
    $pdf->Output();
}


?>