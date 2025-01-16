<?php ob_start(); ?>
<h2>Categories</h2>
<p>Find below all our categories:</p>
<ul>
    <?php if (isset($categories)): ?>
        <?php foreach ($categories as $category): ?>
            <li><a href="/category/<?= $category['slug']; ?>"><?= htmlspecialchars($category['name']); ?></a></li>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No subcategories available.</p>
    <?php endif; ?>
</ul>

