<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: SignIn.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background: url('https://jooinn.com/images/color-background-5.png') no-repeat center center fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0;
            color: #fff;
        }

      
        .container {
            background: #ADD8E6; 
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px; /* Fixed width */
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        a {
            font-size: 1.1rem;
            color: #0000FF;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to this Page!</h2>
        <p>Hello, <?php echo $_SESSION['user']; ?> </p>
        <a href="Logout.php">Logout</a>
    </div>
</body>
</html>
