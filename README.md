# Online-bookstore

## Description
This project simulates an **online bookstore** using PHP, where users can add books, view the inventory with prices and discounts applied, and check server details (such as IP address and user agent). The system also keeps a log of user actions, like adding new books, in a log file.

The system allows:
- Displaying an inventory of books with both original prices and applied discounts.
- Automatically applying a **10% discount** to books in the "Science Fiction" genre, **20% discount** to books in the "Comedy" genre and **5% discount** in "Fantasy" genre.
- Showing the discount percentage applied.
- Logging user actions (such as adding a book) in a log file with the timestamp, IP address, and user agent.

## Requirements

- **PHP** 7.0 or higher.
- A web server with PHP support like AMMPS.

## Project Structure

- `index.php`: The main script that contains the bookstore logic, handles the book input form, discount calculations, and displays the inventory.
- `bookstore_log.txt`: A text file where user actions, such as adding new books, are logged (it will be populated automatically).
- `README.md`: This file with information about the project.

## Features

1. **Book Inventory**:
   - Books are stored in a multidimensional array with keys: `title`, `author`, `genre`, `price`, and `original_price` (the original price before any discounts).

2. **Automatic Discount**:
   - The system automatically applies discounts to the gneres "Science fiction", "Comedy" and "Fantasy" genre and displays the **original price**, **discounted price**, and **discount percentage**.

3. **Add Books Form**:
   - Users can add new books to the inventory using a form.
   - The input is validated to ensure no empty fields and that the price is a valid number.

4. **Total Price Calculation**:
   - After discounts are applied, the system calculates and displays the **total price** of the inventory after discounts.

5. **Action Logging**:
   - Every time a new book is added, the action is logged in `bookstore_log.txt` with the timestamp, IP address, and user agent.
   - The log entry format is as follows:
     ```
     [YYYY-MM-DD HH:MM:SS] IP: xxx.xxx.xxx.xxx | UA: User-Agent-Info | Added book: "Book Title" (Genre, Price)
     ```

6. **Server Information**:
   - The current date and time, user's IP address, and user agent are displayed on the page.

## Installation and Usage

1. **Clone or Download the Repository**:
   in Git Bash:
   git clone git@github.com:DiegoEstrada07/Online-bookstore.git