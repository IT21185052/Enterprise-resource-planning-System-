<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];
    $district = $_POST['district'];

    // Use prepared statements to insert the new customer
    $sql = "INSERT INTO customer (title, first_name, last_name, contact_no, district) 
            VALUES (:title, :first_name, :last_name, :contact_no, :district)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':contact_no', $contact_number);
    $stmt->bindParam(':district', $district);

    if ($stmt->execute()) {
        $message = "New customer added successfully";
    } else {
        $message = "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<h2>Add Customer</h2>
<form action="" method="post" class="needs-validation" novalidate>
    <div class="form-group">
        <label for="title">Title</label>
        <select class="form-control" id="title" name="title" required>
            <option value="">Select Title</option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
        </select>
        <div class="invalid-feedback">Please select a title.</div>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" pattern="[A-Za-z]+" required>
        <div class="invalid-feedback">Please enter a first name.</div>
        <small id="first_name_error" class="form-text text-danger"></small>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" pattern="[A-Za-z]+" required>
        <div class="invalid-feedback">Please enter a last name.</div>
        <small id="last_name_error" class="form-text text-danger"></small>
    </div>
    <div class="form-group">
        <label for="contact_number">Contact Number</label>
        <input type="text" class="form-control" id="contact_number" name="contact_number" pattern="\d{10}" required>
        <div class="invalid-feedback">Please enter a contact number.</div>
        <small id="contact_number_error" class="form-text text-danger"></small>
    </div>
    <div class="form-group">
        <label for="district">District</label>
        <input type="text" class="form-control" id="district" name="district" required>
        <div class="invalid-feedback">Please enter a district.</div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php if ($message): ?>
<script>
    alert("<?php echo $message; ?>");
</script>
<?php endif; ?>

<script>
document.querySelector('form').addEventListener('submit', function (event) {
    // Custom validation for first name
    const firstNameInput = document.getElementById('first_name');
    const firstNameError = document.getElementById('first_name_error');
    const firstNamePattern = /^[A-Za-z]+$/;
    if (!firstNamePattern.test(firstNameInput.value)) {
        firstNameError.textContent = 'Please enter letters only.';
        event.preventDefault();
    } else {
        firstNameError.textContent = '';
    }

    // Custom validation for last name
    const lastNameInput = document.getElementById('last_name');
    const lastNameError = document.getElementById('last_name_error');
    if (!firstNamePattern.test(lastNameInput.value)) {
        lastNameError.textContent = 'Please enter letters only.';
        event.preventDefault();
    } else {
        lastNameError.textContent = '';
    }

    // Custom validation for contact number
    const contactNumberInput = document.getElementById('contact_number');
    const contactNumberError = document.getElementById('contact_number_error');
    const contactNumberPattern = /^\d{10}$/;
    if (!contactNumberPattern.test(contactNumberInput.value)) {
        contactNumberError.textContent = 'Please enter a valid 10-digit number.';
        event.preventDefault();
    } else {
        contactNumberError.textContent = '';
    }
});
</script>

<?php include '../includes/footer.php'; ?>
