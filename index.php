<?php
//          ᓚᘏᗢ
//1. Book inventory stored as an array of associative arrays
$books = [
    [
        'title' => 'Dune',
        'author' => 'Frank Herbert',
        'genre' => 'Science Fiction',
        'price' => 29.99
    ],
    [
        'title' => '1984',
        'author' => 'George Orwell',
        'genre' => 'Dystopian',
        'price' => 19.99
    ],
    [
        'title' => 'To Kill a Mockingbird',
        'author' => 'Harper Lee',
        'genre' => 'Classic Fiction',
        'price' => 14.99
    ],
    [
        'title' => 'The Hobbit',
        'author' => 'J.R.R. Tolkien',
        'genre' => 'Fantasy',
        'price' => 24.99
    ],
    [
        'title' => 'The Great Gatsby',
        'author' => 'F. Scott Fitzgerald',
        'genre' => 'Classic Fiction',
        'price' => 12.99
    ],
    [
        'title' => 'The Catcher in the Rye',
        'author' => 'J.D. Salinger',
        'genre' => 'Literary Fiction',
        'price' => 18.50
    ],
    [
        'title' => 'La celestina',
        'author' => 'Fernando de rojas',
        'genre' => 'Comedy',
        'price' => 19.50
    ]
];
//    ᓚᘏᗢ
//2. Function to apply a 10% discount to all books in the "Science Fiction" genre
function applyDiscounts(array &$books) {
    foreach ($books as &$book) {
        if ($book['genre'] === 'Science Fiction') {
            $book['original_price'] = $book['price'];
            $book['price'] *= 0.90; // Apply 10% discount
        } else if ($book['genre'] === 'Comedy') {
            $book['original_price'] = $book['price'];
            $book['price'] *= 0.80; // Apply 20% discount
        }else if ($book['genre'] === 'Fantasy') {
            $book['original_price'] = $book['price'];
            $book['price'] *= 0.95; // Apply 5% discount
        }else{
            $book['original_price'] = $book['price'];
        }
    }
}
applyDiscounts($books);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $author = isset($_POST['author']) ? trim($_POST['author']) : '';
    $genre = isset($_POST['genre']) ? trim($_POST['genre']) : '';
    $price = isset($_POST['price']) && is_numeric($_POST['price']) ? floatval($_POST['price']) : 0;

    if ($title && $author && $genre && $price > 0) {
        // Add the new book
        $books[] = [
            'title' => $title,
            'author' => $author,
            'genre' => $genre,
            'price' => $price
        ];

        // Apply discounts again
        applyDiscounts($books);

        
        $log_entry = sprintf(
            "[%s] IP: %s | UA: %s | Added book: \"%s\" (%s, %.2f)\n",
            date('Y-m-d H:i:s'),
            $_SERVER['REMOTE_ADDR'],
            $_SERVER['HTTP_USER_AGENT'],
            $title,
            $genre,
            $price
        );

        file_put_contents('bookstore_log.txt', $log_entry, FILE_APPEND);
    }
}

//ᓚᘏᗢ
//4. Total price calculator
$total_price = 0;
foreach ($books as $book) {
    $total_price += $book['price'];
}

//ᓚᘏᗢ
// 6. server info & timestamp
$date_time = date('Y-m-d H:i:s');
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Online Bookstore</h1>
    <!--ᓚᘏᗢ-->
    <!-- 3. User imput handling -->
    <form action="" method="POST">
        <h2>Add New Book</h2>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="author">Author:</label>
        <input type="text" name="author" id="author" required><br><br>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" id="genre" required><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" required><br><br>

        <input type="submit" value="Add Book">
    </form>

    <h2>Book Inventory</h2>
    <h3>Book discounts:</h3>
    <ul>
        <li>Science fiction</li>
        <li>Comedy</li>
        <li>Fantasy</li>
    </ul>
<!--ᓚᘏᗢ-->
<!-- 5. Output Formating-->
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Original Price</th>
                <th>Discounted Price</th>
                <th>Discount Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?php echo htmlspecialchars($book['title']); ?></td>
                <td><?php echo htmlspecialchars($book['author']); ?></td>
                <td><?php echo htmlspecialchars($book['genre']); ?></td>
                <td>
                    <?php echo '$' . number_format($book['original_price'], 2); ?>
                </td>
                <td>
                    <?php echo '$' . number_format($book['price'], 2); ?>
                </td>
                <td>
                    <?php 
                        if ($book['price'] < $book['original_price']) {
                            $discount_percentage = (($book['original_price'] - $book['price']) / $book['original_price']) * 100;
                            echo number_format($discount_percentage, 2) . '%';
                        } else {
                            echo '0%';
                        }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Total Price after Discounts: $<?php echo number_format($total_price, 2); ?></h3>

    <h4>Server Info:</h4>
    <p>Request Time: <?php echo $date_time; ?></p>
    <p>IP: <?php echo $ip_address; ?></p>
    <p>User Agent: <?php echo $user_agent; ?></p>

</body>
</html>