<?php
session_start();
include("connection.php");
include("functions.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; 

// Get the book ID from the URL parameter
if (isset($_GET['id'])) {
    $bookID = $_GET['id'];
} else {
    die("Book ID is missing.");
}

// Fetch book details from the database
$sql = "SELECT * FROM Books WHERE bookID = $bookID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Book not found.");
}

// Extract tags from the database
$tags = array_filter([$row['tag1'], $row['tag2'], $row['tag3']]);

// ... (Rest of your HTML code, with PHP embedded) ...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    </head>
<body>
    <header>
        <h1>QuikBook</h1>
        <nav>
            <button onclick="location.href='logout.php'">Logout</button>
            <button onclick="location.href='loginproduct.html'">Products/Services</button>
            <button onclick="location.href='dashboard.php'">Back To Dashboard</button>
        </nav>
    </header>

    <main>
        <div class="book-details">
            <div class="book-image">
                <img src="<?php echo $row['cover_image']; ?>" alt="<?php echo $row['title']; ?>" width="400" height="650" style="display: block; margin-left: auto; margin-right: auto;">
            </div>

            <div class="book-info">
                <h2><?php echo $row['title']; ?></h2>

                <div class="tags">
                    <?php foreach ($tags as $tag): ?>
                        <span class="tag"><?php echo $tag; ?></span>
                    <?php endforeach; ?>
                </div>

                <p>Renting Price: $<?php echo $row['renting_price']; ?></p>
                <button class="rent-btn" onclick="location.href='purchase.html'">Rent for $<?php echo $row['renting_price']; ?></button>

                <div class="description-box">
                    <ul class="book-specs">
                        <li>Description: <?php echo $row['description']; ?></li>
                    </ul>
                </div>

                <h2>Preview Pages:</h2>
                <div class="preview-pages">
                    <div class="preview-thumbnail" onclick="openLightbox('<?php echo $row['preview_image1']; ?>')">
                        <img src="<?php echo $row['preview_image1']; ?>" alt="Preview 1">
                    </div>
                    <div class="preview-thumbnail" onclick="openLightbox('<?php echo $row['preview_image2']; ?>')">
                        <img src="<?php echo $row['preview_image2']; ?>" alt="Preview 2">
                    </div>
                    <div class="preview-thumbnail" onclick="openLightbox('<?php echo $row['preview_image3']; ?>')">
                        <img src="<?php echo $row['preview_image3']; ?>" alt="Preview 3">
                    </div>
                    <div class="preview-thumbnail" onclick="openLightbox('<?php echo $row['preview_image4']; ?>')">
                        <img src="<?php echo $row['preview_image4']; ?>" alt="Preview 4">
                    </div>
                </div>

                <div class="inquiry-wrapper">
                    <button class="inquiry-btn" onclick="location.href='contactlogin.html'">Contact Us For Inquiries</button>
                </div>

                <div id="lightbox" class="lightbox">
                    <span class="close" onclick="closeLightbox()">&times;</span>
                    <img id="lightbox-image" src="" alt="Lightbox Image">
                    <a class="prev" onclick="prevImage()">&#10094;</a>
                    <a class="next" onclick="nextImage()">&#10095;</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; QuikBook 2024</p>
    </footer>

    <script>
        const images = [
            "<?php echo $row['preview_image1']; ?>",
            "<?php echo $row['preview_image2']; ?>",
            "<?php echo $row['preview_image3']; ?>",
            "<?php echo $row['preview_image4']; ?>"
        ];
        let currentIndex = 0;

        // ... (Rest of your JavaScript code) ...
    </script>
</body>
</html>

<?php
$conn->close();
?>