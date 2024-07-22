<?php include '../includes/db.php'; ?>

<?php
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "SELECT invoice.*, customer.first_name, customer.last_name, customer.district 
            FROM invoice 
            LEFT JOIN customer ON invoice.customer = customer.id 
            WHERE date BETWEEN :start_date AND :end_date";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();
    $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($invoices) {
        $filename = "invoice_report_" . date('Ymd') . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        $output = fopen('php://output', 'w');
        fputcsv($output, array('Invoice Number', 'Date', 'Customer', 'Customer District', 'Item Count', 'Invoice Amount'));

        foreach ($invoices as $invoice) {
            fputcsv($output, array($invoice['invoice_no'], $invoice['date'], $invoice['first_name'] . ' ' . $invoice['last_name'], $invoice['district'], $invoice['item_count'], $invoice['amount']));
        }
        fclose($output);
        exit;
    } else {
        echo "No records found.";
    }
}
?>
