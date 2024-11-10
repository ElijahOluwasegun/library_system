<?php
include("configurations/connect.php");

// Check if an ID was passed to the page
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the book from the database
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Book deleted successfully.";
    } else {
        $message = "Error deleting book.";
    }

    // Redirect back to the main interface with a message
    header("Location: booksinterface.php?message=" . urlencode($message));
    exit();
} else {
    die("Invalid request.");
}
?>
