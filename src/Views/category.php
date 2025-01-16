<?php ob_start(); ?>

<?php if (isset($category)): ?>
    <h2><?= htmlspecialchars($category['name']); ?></h2>
    <hr>
    <h4>Sub Categories</h4>
    <ul class="list-unstyled">
        <?php if (isset($subcategories) && !empty($subcategories)): ?>
            <?php foreach ($subcategories as $subcategory): ?>
                <li><a href="/category/<?= $category['slug']; ?>/<?= $subcategory['slug']; ?>"><?= htmlspecialchars($subcategory['name']); ?></a></li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No subcategories available.</p>
        <?php endif; ?>
    </ul>
<?php else: ?>
    <p>Category not found.</p>
<?php endif; ?>
