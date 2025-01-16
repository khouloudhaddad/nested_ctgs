# Nested Categories with Friendly URLs (PHP OOP)

This project demonstrates a PHP application that manages nested categories with friendly URLs. It follows an OOP (Object-Oriented Programming) structure, uses the MVC (Model-View-Controller) pattern, and integrates **Bootstrap 5** for styling.

---

## Features

- **Nested Categories**: Categories can have unlimited levels of subcategories.
- **Friendly URLs**: SEO-friendly URLs like `/category/electronics/mobile-phones`.
- **Dynamic Navigation**: Navbar dynamically lists top-level categories.
- **Bootstrap 5 Integration**: Responsive design and modern styling.
- **Scalable Structure**: Organized project structure with OOP principles.

---

## Project Structure

```
nested_ctgs/
├── public/
│   ├── .htaccess        # URL rewriting rules
│   ├── index.php        # Front controller and homepage
│   ├── category.php     # Handles category display
│   └── item.php         # Handles item display
├── src/
│   ├── Config/
│   │   └── Database.php  # Database connection
│   ├── Models/
│   │   └── Category.php  # Category model
│   ├── Controllers/
│   │   └── CategoryController.php  # Handles category logic
│   └── Views/
│       ├── layout.php    # Common HTML layout
│       ├── category.php  # Displays categories and subcategories
│       └── item.php      # Displays items
└── composer.json        # Composer autoloader configuration
```

---

## Prerequisites

- **PHP 7.4+**
- **MySQL**
- **Composer**

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/nested-categories.git
   cd nested-categories
   ```

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

3. Import the database schema:
   ```sql
   CREATE TABLE categories (
       id INT AUTO_INCREMENT PRIMARY KEY,
       parent_id INT DEFAULT NULL,
       name VARCHAR(255) NOT NULL,
       slug VARCHAR(255) NOT NULL UNIQUE,
       FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE CASCADE
   );

   INSERT INTO categories (parent_id, name, slug) VALUES
   (NULL, 'Electronics', 'electronics'),
   (NULL, 'Fashion', 'fashion'),
   (1, 'Mobile Phones', 'mobile-phones'),
   (1, 'Laptops', 'laptops'),
   (3, 'Smartphones', 'smartphones'),
   (3, 'Feature Phones', 'feature-phones');
   ```

4. Configure your database connection in `src/Config/Database.php`:
   ```php
   private static $instance = new PDO(
       "mysql:host=localhost;dbname=mydb", "root", "",
       [
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
       ]
   );
   ```

5. Set up the web server:
    - Place the `public/` folder as the document root.
    - Ensure `.htaccess` rewriting is enabled for friendly URLs.

---

## Usage

### Homepage
Access the homepage at `/index.php`. It lists all top-level categories in card format.

### Category Pages
Visit `/category/<slug>` to view subcategories of a specific category. URLs like `/category/electronics/mobile-phones` display nested subcategories.

### Navigation
The navigation bar dynamically lists top-level categories and is accessible from all pages.

---

## Example `.htaccess`

```apache
RewriteEngine On

# Redirect category URLs
RewriteRule ^category/([^/]+)/?$ category.php?slug=$1 [L,QSA]
RewriteRule ^category/([^/]+)/([^/]+)/?$ category.php?slug=$2&parent=$1 [L,QSA]
```

---

## Built With

- **PHP 7.4+**: Backend logic
- **MySQL**: Database management
- **Bootstrap 5**: Frontend design
- **Composer**: Autoloading and dependency management

---

## Future Enhancements

- **Search Functionality**: Add a search bar to find categories quickly.
- **Breadcrumbs**: Display hierarchical navigation for categories.
- **Pagination**: Manage long lists of subcategories or items.
- **Admin Panel**: Add an admin interface to manage categories dynamically.

---

## License

This project is open-source and available under the MIT License.
