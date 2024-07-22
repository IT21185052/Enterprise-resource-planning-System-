<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    // Use prepared statements to insert the new item
    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) 
            VALUES (:item_code, :item_name, :item_category, :item_subcategory, :quantity, :unit_price)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':item_code', $item_code);
    $stmt->bindParam(':item_name', $item_name);
    $stmt->bindParam(':item_category', $item_category);
    $stmt->bindParam(':item_subcategory', $item_subcategory);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':unit_price', $unit_price);

    if ($stmt->execute()) {
        $message = "New item added successfully";
    } else {
        $message = "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<h2>Add Item</h2>
<form action="" method="post" class="needs-validation" novalidate>
    <div class="form-group">
        <label for="item_code">Item Code</label>
        <input type="text" class="form-control" id="item_code" name="item_code" required>
        <div class="invalid-feedback">Please enter an item code.</div>
    </div>
    <div class="form-group">
        <label for="item_name">Item Name</label>
        <input type="text" class="form-control" id="item_name" name="item_name" required>
        <div class="invalid-feedback">Please enter an item name.</div>
    </div>
    <div class="form-group">
        <label for="item_category">Item Category</label>
        <select class="form-control" id="item_category" name="item_category" required>
            <option value="">Select Category</option>
            <?php
            $sql = "SELECT * FROM item_category";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch()) {
                echo "<option value='{$row['id']}'>{$row['category']}</option>";
            }
            ?>
        </select>
        <div class="invalid-feedback">Please select an item category.</div>
    </div>
    <div class="form-group">
        <label for="item_subcategory">Item Subcategory</label>
        <select class="form-control" id="item_subcategory" name="item_subcategory" required>
            <option value="">Select Subcategory</option>
            <?php
            $sql = "SELECT * FROM item_subcategory";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch()) {
                echo "<option value='{$row['id']}'>{$row['sub_category']}</option>";
            }
            ?>
        </select>
        <div class="invalid-feedback">Please select an item subcategory.</div>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="text" class="form-control" id="quantity" name="quantity" required>
        <div class="invalid-feedback">Please enter a quantity.</div>
    </div>
    <div class="form-group">
        <label for="unit_price">Unit Price</label>
        <input type="text" class="form-control" id="unit_price" name="unit_price" required>
        <div class="invalid-feedback">Please enter a unit price.</div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php if ($message): ?>
<script>
    alert("<?php echo $message; ?>");
</script>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
