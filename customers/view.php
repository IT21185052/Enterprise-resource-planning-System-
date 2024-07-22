<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<h2>Customer List</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact Number</th>
            <th>District</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM customer";
        $stmt = $pdo->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($customers as $customer) {
            echo "<tr>
                <td>{$customer['id']}</td>
                <td>{$customer['title']}</td>
                <td>{$customer['first_name']}</td>
                <td>{$customer['last_name']}</td>
                <td>{$customer['contact_no']}</td>
                <td>{$customer['district']}</td>
                <td>
                    <a href='edit.php?id={$customer['id']}' class='btn btn-warning'>Edit</a>
                    <a href='delete.php?id={$customer['id']}' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this customer?');\">Delete</a>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>
