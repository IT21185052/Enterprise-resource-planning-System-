<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<h2>Item Report</h2>

<?php
$sql = "SELECT item.item_name, item_category.category, item_subcategory.sub_category, SUM(item.quantity) AS total_quantity 
        FROM item 
        LEFT JOIN item_category ON item.item_category = item_category.id
        LEFT JOIN item_subcategory ON item.item_subcategory = item_subcategory.id
        GROUP BY item.item_name, item.item_category, item.item_subcategory";
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($items) {
    echo "<table class='table table-bordered mt-4'>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Total Quantity</th>
                </tr>
            </thead>
            <tbody>";
    foreach($items as $item) {
        echo "<tr>
                <td>{$item['item_name']}</td>
                <td>{$item['category']}</td>
                <td>{$item['sub_category']}</td>
                <td>{$item['total_quantity']}</td>
            </tr>";
    }
    echo "</tbody></table>";

    // Add a button to download the report as CSV
    echo '<form action="download_item_csv.php" method="post">
            <button type="submit" class="btn btn-secondary mt-2">Download CSV</button>
          </form>';
} else {
    echo "No records found.";
}
?>

<?php include '../includes/footer.php'; ?>
