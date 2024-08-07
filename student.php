
<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 3px;
            display: block;
            margin: 10 auto;
            width: 100px;

        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }

       
    </style>

</head>
<body>
    <div class="container">
        <h1>Student Information</h1>
        <form action="" method="POST">
            <label for="fname">First Name:</label>
            <input  type="text" name="fname" id="fname" required><br><br>
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname"required><br><br>
            <label for="age">Age:</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" name="age" id="age" required><br><br>
            <label for="gender">gender:</label>
            <input type="radio" name="gender" id="gender" value="Male" checked>Male
            <input type="radio" name="gender" id="gender" value="Female">Female <br><br>
            <input type="submit" name="submit" value="Add Student">

    </div>
</body>
</html>
<?php
try{
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $sql = "INSERT INTO students (fname, lname, age, gender) VALUES ('$fname', '$lname', '$age', '$gender')";
        if ($conn->query($sql) === TRUE) {
            echo "Student information added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
catch(Exception $e){
    echo $e->getMessage();
}
?>


<table border="1" style="width:100%">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th colspan="2">Action</th>
    </tr>
    <?php
    $sql = "SELECT * FROM students";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>". $row['id']. "</td>";
            echo "<td>". $row['fname']. "</td>";
            echo "<td>". $row['lname']. "</td>";
            echo "<td>". $row['age']. "</td>";
            echo "<td>". $row['gender']. "</td>";
            echo "<td><a href='update.php?update=". $row['id']. "'>Edit</a></td>";
            echo "<td><a href='student.php?delete=". $row['id']. "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></td>";
            echo "</tr>";
        }
    }
    ?>

    <?php
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $id = mysqli_real_escape_string($conn, $id);
        $sql = "DELETE FROM students WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Record deleted successfully'); window.location.href='student.php';</script>";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    ?>
</table>

