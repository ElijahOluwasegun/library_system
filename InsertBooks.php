<?php
// Step 1: Get Data from the Form [Frontend]
if (isset($_POST['Save']))
{
    $BNo = $_POST['Bookno'];
    $Te = $_POST['Title'];
    $Se = $_POST['Subtitle'];
    $A = $_POST['Author'];
    $Bp = $_POST['Book_publisher'];
    $Bq = $_POST['Book_quantity'];


    //echo $BNo. " ". $Te;


    // Step 2 : Connect to the database
    include("configurations/connect.php");
    // Step 3 : Write the SQL Command
    $stmt = $conn->prepare("INSERT INTO staff (Bookno, Title, Subtitle, Author, Book_publisher, Book_quantity)
    VALUES (:b, :t, :s, :a, :p, :q)");
    $stmt->bindParam(':b', $BNo);
    $stmt->bindParam(':t', $Te);
    $stmt->bindParam(':s', $Se);
    $stmt->bindParam(':a', $A);
    $stmt->bindParam(':p', $Bp);
    $stmt->bindParam(':q', $Bq);
    // Step 4 : Execute the SQL Command
    if($stmt->execute())
    {
        echo "Book Details Successfully Saved";
    }
}


?>
