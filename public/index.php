<?php

use App\Controllers\CategoryController;

require_once __DIR__ . '/../vendor/autoload.php';

$requestUri = $_SERVER['REQUEST_URI'];
$uriSegments = explode('/', trim($requestUri, '/'));

if (isset($uriSegments[0]) && $uriSegments[0] === 'category') {
    // Check if there are two segments (parentSlug and slug)
    if (isset($uriSegments[1]) && isset($uriSegments[2])) {
        // Route to the CategoryController with both parentSlug and slug
        $controller = new CategoryController();
        $controller->showSubcategory($uriSegments[1], $uriSegments[2]); // parentSlug, slug
    }
    // Check if there is only one segment (slug)
    elseif (isset($uriSegments[1])) {
        // Route to the CategoryController with just the slug
        $controller = new CategoryController();
        $controller->showCategory($uriSegments[1]); // slug only
    } else {
        echo "404 Not Found";
    }
} else {
    // Show all top-level categories on the homepage
    $controller = new CategoryController();
    $controller->index();
}
