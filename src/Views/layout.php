
<?php
    $categories = (new \App\Controllers\CategoryController())::$categories;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nested Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Nested Categories</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <?php foreach ($categories as $category): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/category/<?= $category['slug']; ?>"><?= $category['name']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?= $content; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
