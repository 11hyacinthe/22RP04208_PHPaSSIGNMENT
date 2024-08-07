<?php
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
    <title>Student Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        nav {
            background-color: #4CAF50;
            padding: 10px 0;
        }
        nav h1 {
            color: #fff;
            margin: 0;
            padding: 10px;
            display: inline-block;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin-left: 200px;
        }
        nav a:hover {
            background-color: #555;
        }
        .content {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
        }
        p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
           <h1>Student Management System</h1>
            <a href="">Home</a>
            <a href="student.php">Add Student</a>
            <a href="logout.php">Logout</a>
        </nav>
        
        <div class="content">
            <h2>Welcome to Student Management System</h2>
            
        </div>
    </div>

 
</body>
</html>