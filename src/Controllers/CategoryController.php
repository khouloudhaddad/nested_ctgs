<?php

namespace App\Controllers;

use App\Models\Category;
class CategoryController
{
    // Show all top-level categories
    public static $categories = [];
    public function __construct(){
        self::$categories = Category::getAllTopLevel();
    }

    public function index()
    {
        // Include the view content
        ob_start(); // Start output buffering
        include __DIR__ . '/../Views/categories.php'; // Load the specific page content
        $content = ob_get_clean(); // Get the output and assign it to the $content variable

        // Now include the layout and pass the content
        include __DIR__ . '/../Views/layout.php';
    }

    // Show a single category with its subcategories
    public function showCategory($slug)
    {
        $category = Category::getCategoryBySlug($slug); // Get the category by slug
        $subcategories = Category::getSubcategories($slug); // Get the subcategories of the category
        // Start output buffering
        ob_start();
        include __DIR__ . '/../Views/category.php'; // Load the specific page content
        $content = ob_get_clean(); // Get the output

        // Now include the layout and pass the content
        include __DIR__ . '/../Views/layout.php';

    }

    // Show a subcategory under its parent category
    public function showSubcategory($parentSlug, $slug)
    {
        // Handle showing a subcategory
        $category = Category::getCategoryBySlug($slug); // Get subcategory
        $parentCategory = Category::getCategoryBySlug($parentSlug); // Get parent category
        $subcategories = Category::getSubcategories($slug); // Get subcategories of this subcategory
        ob_start();
        include __DIR__ . '/../Views/category.php'; // Load subcategory view
        $content = ob_get_clean();
        include __DIR__ . '/../Views/layout.php'; // Include layout with content
    }
}