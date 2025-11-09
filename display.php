<?php
// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'emp');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// --- Handle form submission (create) ---
if (isset($_POST['create'])) {
    $phonenumber = $_POST['phonenumber'];
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];

    $sql = "INSERT INTO employee (phonenumber, firstname, lastname) 
            VALUES ('$phonenumber', '$Firstname', '$Lastname')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<p style='color:green;'>Record created successfully!</p>";
    } else {
        echo "<p style='color:red;'>Create failed: " . mysqli_error($conn) . "</p>";
    }
}

// --- Handle deletion ---
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $del_sql = "DELETE FROM employee WHERE id = $delete_id";
    $del_result = mysqli_query($conn, $del_sql);
    if ($del_result) {
        echo "<p style='color:green;'>Record deleted successfully!</p>";
    } else {
        echo "<p style='color:red;'>Delete failed: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch all employees for display
$employees = mysqli_query($conn, "SELECT * FROM employee ORDER BY id DESC");

// Helper function to escape output
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees Form</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #eee; }
        .btn-delete { color: white; background: red; border: none; padding: 4px 8px; cursor: pointer; }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                window.location = '?delete_id=' + id;
            }
        }
    </script>
</head>
<body>
    <form action="" method="POST">
        <h1>This is my Employees Form</h1>
        <label>Phone Number:</label>
        <input type="text" name="phonenumber" required><br><br>
        <label>First Name:</label>
        <input type="text" name="Firstname" required><br><br>
        <label>Last Name:</label>
        <input type="text" name="Lastname" required><br><br>
        <button type="submit" name="create">Create</button>
    </form>

    <h2>All Employees</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Phone Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Action</th>
        </tr>
        <?php if(mysqli_num_rows($employees) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($employees)): ?>
                <tr>
                    <td><?php echo e($row['id']); ?></td>
                    <td><?php echo e($row['phonenumber']); ?></td>
                    <td><?php echo e($row['firstname']); ?></td>
                    <td><?php echo e($row['lastname']); ?></td>
                    <td>
                        <button class="btn-delete" onclick="confirmDelete(<?php echo e($row['id']); ?>)">Delete</button>
                               <a class='action edit' href='update.php?id=<?php echo $row['id']; ?>'>Edit</a>

                        
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No employees found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
