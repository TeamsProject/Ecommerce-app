<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="/images/icone.ico">
</head>
<body>

    <form method="POST" class="form">
        <div class="container">
            <?php
            if (isset($_POST["submit"])) {
                include "connect.php";
                extract($_POST);

                $query = "SELECT * FROM Utilisateur WHERE email = '$email' AND password = '$password'";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    $client = mysqli_fetch_assoc($result);
                    if($client['role']==='admin'){
                        header("location:ajouteProduit.php");
                        session_start();
                        $_SESSION['firstname']= $client['firstName'];
                        $_SESSION['lastname']= $client['lastName'];
                        $_SESSION['cin']= $client['cin'];
                        $_SESSION['email']= $client['email'];
                        $_SESSION['tele']= $client['tele'];
                    }
                    else{
                        header("location:home.php");
                        session_start();
                        $_SESSION["idUtilisater"]= $client["idUtilisateur"];
                    }
                    exit();
                } else {
                    echo "<p class='pEreur'>Incorrect email or password. Please try again.</p>";
                }
            }
            ?>
            <h2 class="title">Login</h2>
            <div class="login_row">
                <input type="email" name="email" class="email" placeholder="Email" required/>
                <input type="password" name="password" class="password" placeholder="Password" required/>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="remember" value="remember"/>
                <label for="remember">Remember me</label>
            </div>
            <div class="subDiv">
                <input type="submit" name="submit" class="submit" value="Login"/>
            </div>
            <h5><a href="#">forgot password?</a></h5>
            <h5>Don't have an account? Sign up <a href="signup.php">here</a></h5>
        </div>
    </form>    

</body>
</html>