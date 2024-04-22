<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="logsign.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="bg-img">
        <div class="content">
            <header>SIGN-UP</header>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" maxlength="8" name="user" required placeholder="Username">
                </div>
                <div class="field space">
                    <span class="fa fa-envelope"></span>
                    <input type="email" name="email" required placeholder="Email">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="pass" maxlength="8" class="pass-key" required placeholder="Password">
                </div>
                <br><br><br><br>
                <div class="field">
                    <input type="submit" name="submit" value="SIGN-UP">
                </div>
            </form>
            <br>
            <div class="signup">
                Already have an account?
                <a href="login.php">Login Now</a>
            </div>
        </div>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $con = mysqli_connect("localhost", "root", "", "coffee_bar");
            
            // Check connection
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            $user = mysqli_real_escape_string($con, $_POST['user']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $pass = mysqli_real_escape_string($con, $_POST['pass']);

            $sql = "SELECT * FROM register WHERE username = '$user' OR email = '$email'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('User already exists!');</script>";
            } else {
                $sql = "INSERT INTO register (username, email, password) VALUES ('$user', '$email', '$pass')";
                if (mysqli_query($con, $sql)) {
                    echo "<script>alert('Signup Successful');</script>";
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }

            mysqli_close($con);
        }
    ?>
</body>
</html>
