<?php
include("configurations/connect.php");
$message = "";

// Check if an ID was passed to the page
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the book's current details
    try {
        $stmt = $conn->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            die("Book not found.");
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    // Handle form submission for updating the book
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $BNo = $_POST['bookno'];
        $Te = $_POST['title'];
        $Se = $_POST['subtitle'];
        $A = $_POST['author'];
        $Bp = $_POST['book_publisher'];
        $Bq = $_POST['book_quantity'];

        try {
            $stmt = $conn->prepare("UPDATE books SET bookno = :b, title = :t, subtitle = :s, author = :a, book_publisher = :p, book_quantity = :q WHERE id = :id");
            $stmt->bindParam(':b', $BNo);
            $stmt->bindParam(':t', $Te);
            $stmt->bindParam(':s', $Se);
            $stmt->bindParam(':a', $A);
            $stmt->bindParam(':p', $Bp);
            $stmt->bindParam(':q', $Bq);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "Book details updated successfully.";
                header("Location: booksinterface.php");
                exit();
            } else {
                $message = "Error updating book details.";
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
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
        <p style="color: green; text-align: center;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form action="EditBooks.php?id=<?= htmlspecialchars($id) ?>" method="post">
        <div class="outside-input-group">
            <div class="input-group">
                <label for="">Book Number:</label>
                <input type="text" name="bookno" value="<?= htmlspecialchars($book['bookno']) ?>" required>
            </div>
            <div class="input-group">
                <label for="">Book Title:</label>
                <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>
            <div class="input-group">
                <label for="">Book Subtitle:</label>
                <input type="text" name="subtitle" value="<?= htmlspecialchars($book['subtitle']) ?>">
            </div>
            <div class="input-group">
                <label for="">Author Name:</label>
                <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
            </div>
            <div class="input-group">
                <label for="">Book Publisher:</label>
                <input type="text" name="book_publisher" value="<?= htmlspecialchars($book['book_publisher']) ?>" required>
            </div>
            <div class="input-group">
                <label for="">Book Quantity:</label>
                <input type="number" name="book_quantity" value="<?= htmlspecialchars($book['book_quantity']) ?>" required>
            </div>
        </div>
        <div class="btn">
            <button type="submit">Update Book</button>
        </div>
    </form>
</body>
</html>
