<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login and Registration Form in HTML and CSS | Codehal</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <span class="bg-animate"></span>
        <span class="bg-animate"></span>
        <div class="form-box login">
            <h2 class="animation" style="--i:0; --j:21;">Login</h2>
            <form method="post"> 
                <div class="input-box animation" style="--i:1; --j:22;">
                    <input type="text" name="uname" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box animation" style="--i:2; --j:23;">
                    <input type="password" name="pass" required>
                    <label>Password</label>
                    <i class='bx bxs-lock'></i>
                </div>
                <button type="submit" name="submit" class="btn animation" style="--i:3; --j:24;">Login</button>
                <div class="logreg-link animation" style="--i:4; --j:25;">
                    <p>Don't have an account? <a href="#" class="register-link">Sign Up</a></p>
                </div>
            </form>

        </div>
        <div class="info-text login">
            <h2 class="animation" style="--i:0; --j:20;">Hello Everyone!</h2>
            <p class="animation" style="--i:1; --j:21;">Welcome to Drug Dispenser</p>
        </div>

        <div class="form-box register">
            <h2 class="animation" style="--i:17; --j:0;">Sign Up</h2>
            <form action="signup.php" method="post">
                <div class="input-box animation" style="--i:18; --j:1;">
                    <input type="text" name="Username" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box animation" style="--i:19; --j:2;">
                    <input type="text" name="Email" required>
                    <label>Email</label>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box animation" style="--i:20; --j:3;">
                    <input type="password" name="Password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock'></i>
                </div>
                <button type="submit" class="btn animation" style="--i:21; --j:4;">Sign Up</button>
                <div class="logreg-link animation" style="--i:22; --j:5;">
                    <p>Alraedy have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>

        </div>
        <div class="info-text register">
            <h2 class="animation" style="--i:17; --j:0;">Hello Everyone!</h2>
            <p class="animation" style="--i:18; --j:1;">Welcome to Drug Dispenser</p>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>


<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "website";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $sql = "SELECT username, password FROM signup WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbUsername, $dbPassword);
        $stmt->fetch();
        if ($password == $dbPassword) {
            echo "<script>
alert('Login Successful');
window.location.href='option.html';
</script>";
        } else {
            echo "<script>
alert('Incorrect Password');
</script>";
        }
    } else {
        echo "<script>
        alert('No Account found.Please Sign Up.');
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>