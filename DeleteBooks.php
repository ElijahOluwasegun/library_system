<?php
include("configurations/connect.php");

// Check if an ID was passed to the page
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the book with the specified ID
    try {
        $stmt = $conn->prepare("DELETE FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Redirect back to the books list with a success message
            header("Location: booksinterface.php?message=Book deleted successfully");
            exit();
        } else {
            echo "Error: Could not delete the book.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<p>Invalid request: Book ID is missing. Please go back and select a valid book to delete.</p>";
    echo '<p><a href="booksinterface.php">Return to Book List</a></p>';
}
?>
