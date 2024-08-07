
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            color: #666;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Student Information</h2>
        <?php
        include 'connect.php';
        if(isset($_GET['update'])) {
            $id = $_GET['update'];
            $sql = "SELECT * FROM students WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $age = $row['age'];
                    $gender = $row['gender'];
                    ?>
                    <form action="" method="POST">
                        <label for="fname">First Name:</label>
                        <input type="text" name="fname" id="fname" value="<?php echo $fname;?>">
                        
                        <label for="lname">Last Name:</label>
                        <input type="text" name="lname" id="lname" value="<?php echo $lname;?>">
                        
                        <label for="age">Age:</label>
                        <input type="text" name="age" id="age" value="<?php echo $age;?>">
                        
                        <label>Gender:</label>
                        <div>
                            <input type="radio" name="gender" id="male" value="Male" <?php if($gender == "Male") echo "checked";?>>
                            <label for="male">Male</label>
                            <input type="radio" name="gender" id="female" value="Female" <?php if($gender == "Female") echo "checked";?>>
                            <label for="female">Female</label>
                        </div>
                        
                        <input type="submit" name="update" value="Update Student">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                    </form>
                <?php
                }
            }
        
      
        ?>
    </div>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $sql = "UPDATE students SET fname='$fname', lname='$lname', age='$age', gender='$gender' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Record updated successfully'); window.location.href='student.php';</script>";
        } else {
            echo "Error updating record: ". mysqli_error($conn);
        }
    }
}}
?>
