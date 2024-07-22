<?php
include '../includes/db.php';

$query = "SELECT * FROM item";
$stmt = $pdo->query($query);
$items = $stmt->fetchAll();
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h1 class="display-4">View Items</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Code</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['item_code']); ?></td>
                    <td><?php echo htmlspecialchars($item['item_category']); ?></td>
                    <td><?php echo htmlspecialchars($item['item_subcategory']); ?></td>
                    <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($item['unit_price']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
