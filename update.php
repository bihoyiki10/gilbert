<?php
$conn = mysqli_connect('localhost', 'root', '', 'emp');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the record ID from GET or POST
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if (!$id) {
    die("No ID specified.");
}

if (isset($_POST['update'])) {
    $phonenumber = $_POST['phonenumber'];
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];

    $sql = "UPDATE employee 
            SET phonenumber='$phonenumber', firstname='$Firstname', lastname='$Lastname' 
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>Update is done!</p>";
    } else {
        echo "<p style='color:red;'>Update failed: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch current values to pre-fill form
$result = mysqli_query($conn, "SELECT * FROM employee WHERE id='$id' LIMIT 1");
$employee = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
</head>
<body>
    <form action="" method="POST">
        <h1>Update Employee</h1>
        <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
        <label>Phone Number:</label>
        <input type="text" name="phonenumber" value="<?php echo $employee['phonenumber']; ?>" required><br><br>
        <label>First Name:</label>
        <input type="text" name="Firstname" value="<?php echo $employee['firstname']; ?>" required><br><br>
        <label>Last Name:</label>
        <input type="text" name="Lastname" value="<?php echo $employee['lastname']; ?>" required><br><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
