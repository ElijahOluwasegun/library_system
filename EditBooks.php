<?php
include("configurations/connect.php");
$message = "";

// Check if an ID was passed to the page
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the book's current details
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        die("Book not found.");
    }

    // Handle form submission for updating the book
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $BNo = $_POST['bookno'];
        $Te = $_POST['title'];
        $Se = $_POST['subtitle'];
        $A = $_POST['author'];
        $Bp = $_POST['book_publisher'];
        $Bq = $_POST['book_quantity'];

        $stmt = $conn->prepare("UPDATE books SET bookno=?, title=?, subtitle=?, author=?, book_publisher=?, book_quantity=? WHERE id=?");
        $stmt->bind_param("sssssii", $BNo, $Te, $Se, $A, $Bp, $Bq, $id);

        if ($stmt->execute()) {
            $message = "Book details updated successfully.";
            // Optionally, redirect back to the main page after updating
            header("Location: booksinterface.php");
            exit();
        } else {
            $message = "Error updating book details.";
        }
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <h1 class="header">Edit Book Details</h1>
    <?php if ($message): ?>
        <p style="color: green; text-align: center;"><?= $message ?></p>
    <?php endif; ?>

    <form action="edit_book.php?id=<?= $id ?>" method="post">
        <div class="outside-input-group">
            <div class="input-group">
                <label for="">Book Number:</label>
                <input type="text" name="bookno" value="<?= $book['bookno'] ?>" required>
            </div>
            <div class="input-group">
                <label for="">Book Title:</label>
                <input type="text" name="title" value="<?= $book['title'] ?>" required>
            </div>
            <div class="input-group">
                <label for="">Book Subtitle:</label>
                <input type="text" name="subtitle" value="<?= $book['subtitle'] ?>">
            </div>
            <div class="input-group">
                <label for="">Author Name:</label>
                <input type="text" name="author" value="<?= $book['author'] ?>" required>
            </div>
            <div class="input-group">
                <label for="">Book Publisher:</label>
                <input type="text" name="book_publisher" value="<?= $book['book_publisher'] ?>" required>
            </div>
            <div class="input-group">
                <label for="">Book Quantity:</label>
                <input type="number" name="book_quantity" value="<?= $book['book_quantity'] ?>" required>
            </div>
        </div>
        <div class="btn">
            <button type="submit">Update Book</button>
        </div>
    </form>
</body>
</html>
