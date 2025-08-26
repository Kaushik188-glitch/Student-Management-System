<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php"); // Redirect to login page if not logged in
}

include('db.php');

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    <h1>Student Dashboard</h1>
    <a href="add_student.php" class="button">Add New Student</a>
    <a href="logout.php" class="button logout-btn">Logout</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["course"] . "</td>";
                echo "<td>";
                echo "<a href='edit_student.php?id=" . $row["id"] . "'>Edit</a> | ";
                echo "<a href='delete_student.php?id=" . $row["id"] . "'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No students found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>