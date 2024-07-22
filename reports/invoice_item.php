<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<h2>Invoice Item Report</h2>
<form action="" method="get" class="needs-validation" novalidate>
    <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" required>
        <div class="invalid-feedback">Please select a start date.</div>
    </div>
    <div class="form-group">
        <label for="end_date">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date" required>
        <div class="invalid-feedback">Please select an end date.</div>
    </div>
    <button type="submit" class="btn btn-primary">Generate Report</button>
</form>

<?php
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $sql = "SELECT invoice_master.*, item.item_name, item.item_code, item_category.category, invoice.date, customer.first_name, customer.last_name 
            FROM invoice_master 
            LEFT JOIN item ON invoice_master.item_id = item.id
            LEFT JOIN item_category ON item.item_category = item_category.id
            LEFT JOIN invoice ON invoice_master.invoice_no = invoice.invoice_no
            LEFT JOIN customer ON invoice.customer = customer.id
            WHERE invoice.date BETWEEN :start_date AND :end_date";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();
    $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($invoices) {
        echo "<table class='table table-bordered mt-4'>
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Invoiced Date</th>
                        <th>Customer Name</th>
                        <th>Item Name</th>
                        <th>Item Code</th>
                        <th>Item Category</th>
                        <th>Item Unit Price</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($invoices as $invoice) {
            echo "<tr>
                    <td>{$invoice['invoice_no']}</td>
                    <td>{$invoice['date']}</td>
                    <td>{$invoice['first_name']} {$invoice['last_name']}</td>
                    <td>{$invoice['item_name']}</td>
                    <td>{$invoice['item_code']}</td>
                    <td>{$invoice['category']}</td>
                    <td>{$invoice['unit_price']}</td>
                </tr>";
        }
        echo "</tbody></table>";

        // Add a button to download the report as CSV
        echo '<form action="download_csv.php" method="post">
                <input type="hidden" name="start_date" value="' . $start_date . '">
                <input type="hidden" name="end_date" value="' . $end_date . '">
                <button type="submit" class="btn btn-secondary mt-2">Download CSV</button>
              </form>';
    } else {
        echo "No records found.";
    }
}
?>

<?php include '../includes/footer.php'; ?>
