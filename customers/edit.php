<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the customer details
    $sql = "SELECT * FROM customer WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $customer = $stmt->fetch();

    if (!$customer) {
        echo "Customer not found.";
        exit;
    }
} else {
    echo "Invalid customer ID.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];
    $district = $_POST['district'];

    // Update the customer details
    $sql = "UPDATE customer SET title = :title, first_name = :first_name, last_name = :last_name, contact_no = :contact_number, district = :district WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':contact_number', $contact_number);
    $stmt->bindParam(':district', $district);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>alert('Customer updated successfully!');</script>";

        // Refresh the form with updated values
        $sql = "SELECT * FROM customer WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $customer = $stmt->fetch();
    } else {
        echo "Error updating customer.";
    }
}
?>

<h2>Edit Customer</h2>
<form action="view.php" method="post" class="needs-validation" novalidate>
    <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
    <div class="form-group">
        <label for="title">Title</label>
        <select class="form-control" id="title" name="title" required>
            <option value="">Select Title</option>
            <option value="Mr" <?php echo $customer['title'] == 'Mr' ? 'selected' : ''; ?>>Mr</option>
            <option value="Mrs" <?php echo $customer['title'] == 'Mrs' ? 'selected' : ''; ?>>Mrs</option>
            <option value="Miss" <?php echo $customer['title'] == 'Miss' ? 'selected' : ''; ?>>Miss</option>
            <option value="Dr" <?php echo $customer['title'] == 'Dr' ? 'selected' : ''; ?>>Dr</option>
        </select>
        <div class="invalid-feedback">Please select a title.</div>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($customer['first_name']); ?>" required>
        <div class="invalid-feedback">Please enter a first name.</div>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($customer['last_name']); ?>" required>
        <div class="invalid-feedback">Please enter a last name.</div>
    </div>
    <div class="form-group">
        <label for="contact_number">Contact Number</label>
        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($customer['contact_no']); ?>" required>
        <div class="invalid-feedback">Please enter a contact number.</div>
    </div>
    <div class="form-group">
        <label for="district">District</label>
        <input type="text" class="form-control" id="district" name="district" value="<?php echo htmlspecialchars($customer['district']); ?>" required>
        <div class="invalid-feedback">Please enter a district.</div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include '../includes/footer.php'; ?>
