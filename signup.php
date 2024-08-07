<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 300px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #666;
        }
        input[type="text"],
        input[type="password"] {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

    </style>
    
</head>
<body>
    <div class="container">
    <center>
        <h1>Signup  Form</h1>
      <form  method="POST" action="">
      <label for="username">Username</label>
    <input type="text"name="username" placeholder="Enter Your Username"><br><br>
    <label for="password">Password</label>
    <input type="password"name="password" placeholder="Enter password"><br><br>
    <label for="confirm_password">Confirm Password</label>
    <input type="password"name="confirm_password" placeholder="confirm Password"><br><br>
    <input type="submit"name="signup" value="signup"><a href="index.php">Login</a>


      </form>
    </center>
    </div>
    <?php
    include 'connect.php';
    if (isset($_POST['signup'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if (empty($username)) {
            echo "Username is required";
        } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
            echo "Username should only contain letters and numbers";
        } else {
            // Validate password
            if (empty($password)) {
                echo "Password is required";
            } elseif (strlen($password) < 8) {
                echo "Password must be at least 8 characters long";
            } elseif (!preg_match("/[A-Za-z]/", $password) ) {
                echo "Password must contain both uppercase and lowercase letters";
            } elseif ($password != $confirm_password) {
                echo "Password and confirm password do not match";
            } else{
        if ($password == $confirm_password) {
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            if (mysqli_query($conn, $sql)) {
                echo "Signup successful";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Password and confirm password do not match";
        }
    }}}
    
    ?>
    
