<?php

namespace App\Models;

use App\Config\Database;

class Category
{
    // Get all top-level categories
    public static function getAllTopLevel()
    {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM categories WHERE parent_id IS NULL");
        return $stmt->fetchAll();
    }

    // Get subcategories for a given category slug
    public static function getSubcategories($parentSlug)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM categories WHERE parent_id = (SELECT id FROM categories WHERE slug = ?)");
        $stmt->execute([$parentSlug]);
        return $stmt->fetchAll();
    }

    // Get a category by its slug
    public static function getCategoryBySlug($slug)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM categories WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
}