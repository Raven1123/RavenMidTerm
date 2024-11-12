<?php
session_start();
include 'database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    // Collect form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $organization = $_POST['organization'];
    $position = $_POST['position'];
    $address = $_POST['address']; 
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email is already taken!');</script>";
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (email, password, first_name, last_name, organization, position, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $email, $hashed_password, $first_name, $last_name, $organization, $position, $address);

        if ($stmt->execute()) {
            echo "<script>alert('Sign up successful!'); window.location.href = 'signin.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: url('https://jooinn.com/images/color-background-5.png') no-repeat center center fixed;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                background: #ADD8E6;
                padding: 30px;
                border-radius: 8px;
                width: 350px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            h2 {
                color: #444;
                margin-bottom: 15px;
            }

            /* Flex container for the form */
            form {
                display: flex;
                flex-direction: column;
            }

            .form-group {
                display: flex;
                justify-content: space-between;
                margin-bottom: 15px;
            }

            .form-group label {
                width: 30%; /* Controls the width of the label */
                text-align: left;
                font-size: 14px;
            }

            .form-group input {
                width: 65%; /* Controls the width of the input field */
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ddd;
                font-size: 14px;
            }

            button {
                width: 100%;
                padding: 12px;
                background-color: #0000FF;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                margin-top: 10px;
            }

            .switch-link {
                color: #000000;
                cursor: pointer;
                margin-top: 10px;
                display: inline-block;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <h2>Sign Up</h2>
            <form action="signup.php" method="post">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="organization">Organization:</label>
                    <input type="text" name="organization" placeholder="Organization" required>
                </div>
                <div class="form-group">
                    <label for="position">Position:</label>
                    <input type="text" name="position" placeholder="Position" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" placeholder="Address" required>
                </div>
                <button type="submit" name="signup">Sign Up</button>
            </form>
            <p class="switch-link">Already have an account? <a href="signin.php">Sign In</a></p>
        </div>
    </body>
</html>
