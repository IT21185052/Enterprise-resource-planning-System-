<?php
include '../includes/header.php'; 
include '../includes/db.php';


if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $query = "SELECT * FROM item WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$itemId]);
    $item = $stmt->fetch();

    if (!$item) {
        echo "Item not found!";
        exit;
    }
} else {
    echo "No item ID specified!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemCode = $_POST['item_code'];
    $itemCategory = $_POST['item_category'];
    $itemSubcategory = $_POST['item_subcategory'];
    $itemName = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unit_price'];

    $updateQuery = "UPDATE item SET item_code = ?, item_category = ?, item_subcategory = ?, item_name = ?, quantity = ?, unit_price = ? WHERE id = ?";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute([$itemCode, $itemCategory, $itemSubcategory, $itemName, $quantity, $unitPrice, $itemId]);

   

    header('Location: view.php');
    exit;
}
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h1 class="display-4">Edit Item</h1>
    <form action="edit.php?id=<?php echo $item['id']; ?>" method="post">
        <div class="form-group">
            <label for="item_code">Item Code</label>
            <input type="text" class="form-control" id="item_code" name="item_code" value="<?php echo htmlspecialchars($item['item_code']); ?>" required>
        </div>
        <div class="form-group">
            <label for="item_category">Category</label>
            <input type="text" class="form-control" id="item_category" name="item_category" value="<?php echo htmlspecialchars($item['item_category']); ?>" required>
        </div>
        <div class="form-group">
            <label for="item_subcategory">Subcategory</label>
            <input type="text" class="form-control" id="item_subcategory" name="item_subcategory" value="<?php echo htmlspecialchars($item['item_subcategory']); ?>" required>
        </div>
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo htmlspecialchars($item['item_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" required>
        </div>
        <div class="form-group">
            <label for="unit_price">Unit Price</label>
            <input type="number" class="form-control" id="unit_price" name="unit_price" value="<?php echo htmlspecialchars($item['unit_price']); ?>" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
