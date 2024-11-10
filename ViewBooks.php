<?php
// Connect to the database
$servername = "127.0.0.1";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "library_system"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the books table
$sql = "SELECT id, bookno, title, subtitle, author, book_publisher, book_quantity FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books List</title>
    <style>
        /* Add some basic styling */
        table { width: 50%; margin: auto; border-collapse: collapse; }
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
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Display each book's data
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["bookno"] . "</td><td>" . $row["title"] . "</td><td>" . $row["subtitle"] . "</td><td>" . $row["author"] . "</td><td>" . $row["book_publisher"] . "</td><td>" . $row["book_quantity"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No books available</td></tr>";
        }
        ?>
    </table>
    <p>
        <a href="booksinterface.php">Add New Book</a>
    </p>
    <p>
        <a href="EditBooks.php">Edit Book Information</a>
    </p>
    <p>
        <a href="booksinterface.php">Delete Books</a>
    </p>
</body>
</html>

<?php
$conn->close();
?>
