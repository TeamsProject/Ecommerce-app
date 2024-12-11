<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav.css">
    <title>Document</title>
</head>
<body>
        <header>
            <div class="logo"><a href="home.php"><img src="../images/shopart-removebg-preview.png"/></a></div>
            <div class="hamburger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <nav class="navbar">
                <ul>
                    <li><a class="active" href="home">home</a></li>
                       <li><a href="about">about</a></li>
                       <li><a href="products">products</a></li>
                       <li><a href="contact">contact</a></li> 
                       <li><a class="signup" href="sign-up.php">Sign up</a></li>
                       <li><a class="login" href="login.php">Login</a></li>

                </ul>
            </nav>
        </header>
        <script>
            hamburger =document.querySelector(".hamburger")
            hamburger.onclick = function(){
                navbar = document.querySelector(".navbar")
                navbar.classList.toggle("active")
            }
        </script>
</body>
</html>