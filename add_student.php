<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')";

    if ($conn->query($sql) === TRUE) {
        header("location: index.php"); // Redirect to dashboard after adding
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    <h1>Add New Student</h1>
    <a href="index.php" class="button">Go Back</a>
</div>

<div class="form-container">
    <form method="post" action="add_student.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="course">Course:</label>
        <input type="text" id="course" name="course" required>

        <button type="submit">Add Student</button>
    </form>
</div>

</body>
</html>