<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Step 1: Get Data from the Form [Frontend]
if (isset($_POST['Save']))
{
    $StudNo = $_POST['studentno'];
    $FN = $_POST['firstname'];
    $LN = $_POST['lastname'];
    $E = $_POST['email'];
    $P = $_POST['phoneno'];
    $Cp = $_POST['programme_code'];
    $by = $_POST['book_createdby'];

    //echo $FN. " ". $LN;

    // Step 2 : Connect to the database
    include("configurations/connect.php");
    // Step 3 : Write the SQL Command
    $stmt = $conn->prepare("INSERT INTO students (studentno, firstname, lastname, email, phoneno, programme_code, book_createdby)
    VALUES (:s, :f, :l, :e, :p, :c, :b)");
    $stmt->bindParam(':s', $StudNo);
    $stmt->bindParam(':f', $FN);
    $stmt->bindParam(':l', $LN);
    $stmt->bindParam(':e', $E);
    $stmt->bindParam(':p', $P);
    $stmt->bindParam(':c', $Cp);
    $stmt->bindParam(':b', $by);
    // Step 4 : Execute the SQL Command
    if($stmt->execute())
    {
        echo "Student Details Successfully Saved";
    }
}




?>
