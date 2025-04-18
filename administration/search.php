<?php
require_once '../dbconfig/dbconfig.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

$sql = "SELECT id, Name, Category, CreatedDate FROM item";
$params = [];

if ($q !== '') {
    $sql .= " WHERE Name LIKE :query OR Category LIKE :query";
    $params[':query'] = '%' . $q . '%';
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table-auto  min-w-full table-auto text-left" id="productTable">
                    <thead class="bg-[#272c2b] text-white">
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Category</th>
            <th class="px-4 py-2">Date</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <tr class="border-t" data-category="<?= htmlspecialchars($product['Category']) ?>">
                            <td class="px-4 py-2"><?= $product['id'] ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($product['Name']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($product['Category']) ?></td>
                            <td class="px-4 py-2"><?= $product['CreatedDate'] ?></td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </td>
                            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr >
                <td colspan="5" class="px-4 py-2 text-center">No products found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
