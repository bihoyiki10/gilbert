<?php
// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'emp');

// Check connection first (move this outside of POST check)
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// When the form is submitted
if (isset($_POST['create'])) {
    $phonenumber = $_POST['phonenumber'];
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];

    // Insert query
    $sql = "INSERT INTO employee (phonenumber, firstname, lastname) 
            VALUES ('$phonenumber', '$Firstname', '$Lastname')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<p style='color:green;'>Create is done successfully!</p>";
    } else {
        echo "<p style='color:red;'>Create failed: " . mysqli_error($conn) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees Form</title>
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
</body>
</html>
