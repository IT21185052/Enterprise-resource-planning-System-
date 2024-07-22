<?php include '../includes/db.php'; ?>

<?php
// Query to fetch item report data
$sql = "SELECT item.item_name, item_category.category, item_subcategory.sub_category, SUM(item.quantity) AS total_quantity 
        FROM item 
        LEFT JOIN item_category ON item.item_category = item_category.id
        LEFT JOIN item_subcategory ON item.item_subcategory = item_subcategory.id
        GROUP BY item.item_name, item.item_category, item.item_subcategory";
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($items) {
    $filename = "item_report_" . date('Ymd') . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $filename);

    $output = fopen('php://output', 'w');
    fputcsv($output, array('Item Name', 'Category', 'Subcategory', 'Total Quantity'));

    foreach ($items as $item) {
        fputcsv($output, array($item['item_name'], $item['category'], $item['sub_category'], $item['total_quantity']));
    }
    fclose($output);
    exit;
} else {
    echo "No records found.";
}
?>
