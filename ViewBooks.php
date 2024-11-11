<?php
// Connect to the database
$servername = "127.0.0.1";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "library_system"; // Replace with your database name

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the books table
$sql = "SELECT id, bookno, title, subtitle, author, book_publisher, book_quantity FROM books";
$stmt = $conn->prepare($sql);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books List</title>
    <style>
        /* Basic styling */
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { padding: 8px 12px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Available Books</h2>
    <table>
        <tr>
            <th>Book ID</th>
            <th>Book No</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Author</th>
            <th>Book Publisher</th>
            <th>Book Quantity</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book['id']) ?></td>
                <td><?= htmlspecialchars($book['bookno']) ?></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['subtitle']) ?></td>
                <td><?= htmlspecialchars($book['author']) ?></td>
                <td><?= htmlspecialchars($book['book_publisher']) ?></td>
                <td><?= htmlspecialchars($book['book_quantity']) ?></td>
                <td>
                    <a href="EditBooks.php?id=<?= htmlspecialchars($book['id']) ?>">Edit</a> |
                    <a href="DeleteBooks.php?id=<?= htmlspecialchars($book['id']) ?>" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
