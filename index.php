
<?php
include 'connect.php';
session_start();
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color:#4CAF50;
        }
        .signup-link {
            text-align: center;
            margin-top: 15px;
            display: block;
            color: #4CAF50;
            text-decoration: none;
        }
    </style>


</head>
<body>
   
    <div class="container">
    <h2>Login Form</h2>
        <form action="" method="POST">

        <?php 
        $usernamevalue="";
        $passwordvalue="";
        if(isset($_COOKIE['userinfo'])){
            $usercookie=unserialize($_COOKIE['userinfo']);
            $usernamevalue = $usercookie['username'];
            $passwordvalue = $usercookie['password'];

        }
        ?>
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $usernamevalue; ?>" id="username"><br><br>
            <label for="password">Password</label>
            <input type="password" name="password" value="<?php echo $passwordvalue; ?>" id="password"><br><br>
            <input type="submit" name="submit" value="Login"> <a class="signup-link" href="signup.php">Signup</a>

        </form> 
       
    </div>
    
</body>
</html>
<?php
try {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql=mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        if (mysqli_num_rows($sql) > 0) {
            $_SESSION['username'] = $username;

            $userinfo=[
                "username" => $username,
                "password" => $password

            ];
            setcookie("userinfo", serialize($userinfo), time() + 60 * 60 * 24 * 30);
            header("Location: home.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    }}
    catch (Exception $e) {
        echo $e->getMessage();
    }
?>
<?php
